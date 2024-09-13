<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class QrScannerController extends Controller
{
    public function index()
    {
        return view('scanner.scannerAbsensi');
    }

    public function storeAttendance(Request $request)
    {
        $request->validate([
            'qr_code' => 'required',
            'type' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Get scanner location and radius settings
        $scannerLat = Cache::get('scanner_latitude');
        $scannerLng = Cache::get('scanner_longitude');
        $radius = Cache::get('scanner_radius');
        
        // Calculate distance
        $distance = $this->calculateDistance($request->latitude, $request->longitude, $scannerLat, $scannerLng);
        if ($distance > $radius) {
            return response()->json(['error' => 'Tidak dalam lokasi'], 400);
        }

        \Log::info('Data diterima: ', $request->all());

        $qrCode = $request->input('qr_code');
        $type = $request->input('type');
        $currentUser = Auth::user();

        try {
            if ($currentUser->isStudent()) {
                $student = User::where('email', $currentUser->email)
                                ->where('qr_code', $qrCode)
                                ->first();

                if ($student) {
                    return $this->recordAttendance($currentUser, 'siswa', $type);
                } else {
                    return response()->json(['error' => 'QR Code tidak sesuai dengan akun siswa yang sedang login.'], 400);
                }
            } elseif ($currentUser->isCoach()) {
                if ($currentUser->qr_code === $qrCode) {
                    return $this->recordAttendance($currentUser, 'pelatih', $type);
                } else {
                    $student = User::where('qr_code', $qrCode)
                                    ->whereHas('roles', function ($query) {
                                        $query->where('name', 'siswa');
                                    })
                                    ->first();

                    if ($student) {
                        return $this->recordAttendance($student, 'siswa', $type);
                    } else {
                        return response()->json(['error' => 'QR Code tidak sesuai dengan akun pelatih yang sedang login.'], 400);
                    }
                }
            }

            return response()->json(['error' => 'Anda tidak diizinkan untuk melakukan absensi.'], 403);
        } catch (\Exception $e) {
            \Log::error('Error in storeAttendance: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function recordAttendance($user, $role, $type)
    {
        try {
            $existingAttendance = Attendance::where('user_id', $user->id)
                                            ->where('type', $type)
                                            ->whereDate('created_at', Carbon::today())
                                            ->first();

            if ($existingAttendance) {
                if (!$existingAttendance->departure_at) {
                    $existingAttendance->departure_at = Carbon::now();
                    $existingAttendance->save();

                    return response()->json(['success' => 'Kepulangan berhasil dicatat.']);
                } else {
                    return response()->json(['error' => 'Kedatangan dan kepulangan sudah dicatat untuk hari ini.']);
                }
            } else {
                Attendance::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'role' => $role,
                    'type' => $type,
                    'arrival_at' => Carbon::now(),
                ]);

                return response()->json(['success' => 'Kedatangan berhasil dicatat.']);
            }
        } catch (\Exception $e) {
            \Log::error('Error in recordAttendance: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000; // meters

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * 
             sin($dLng/2) * sin($dLng/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $distance = $earthRadius * $c; // Distance in meters

        return $distance;
    }
}
