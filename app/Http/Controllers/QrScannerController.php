<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Schedule;
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

        $scannerLat = Cache::get('scanner_latitude');
        $scannerLng = Cache::get('scanner_longitude');
        $radius = Cache::get('scanner_radius');

        $distance = $this->calculateDistance($request->latitude, $request->longitude, $scannerLat, $scannerLng);
        if ($distance > $radius) {
            return response()->json(['error' => 'Tidak dalam lokasi'], 400);
        }

        $qrCode = $request->input('qr_code');
        $currentUser = Auth::user();

        try {
            if ($currentUser->isStudent()) {
                $student = User::where('email', $currentUser->email)
                                ->where('qr_code', $qrCode)
                                ->first();

                if ($student) {
                    return $this->recordAttendance($currentUser, 'siswa', $request->input('type'));
                } else {
                    return response()->json(['error' => 'QR Code tidak sesuai dengan akun siswa yang sedang login.'], 400);
                }
            }
            elseif ($currentUser->isCoach()) {
                if ($currentUser->qr_code === $qrCode) {
                    return $this->recordAttendance($currentUser, 'pelatih', $request->input('type'));
                } else {
                    $student = User::where('qr_code', $qrCode)
                                    ->whereHas('roles', function ($query) {
                                        $query->where('name', 'siswa');
                                    })
                                    ->first();

                    if ($student) {
                        return $this->recordAttendance($student, 'siswa', $request->input('type'));
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
            $todaySchedule = Schedule::where('title', $type)
                                    ->whereDate('date', Carbon::today())
                                    ->first();

            if (!$todaySchedule) {
                return response()->json(['error' => 'Jadwal tidak ditemukan untuk hari ini.'], 404);
            }

            $existingAttendance = Attendance::where('user_id', $user->id)
                                            ->where('type', $type)
                                            ->whereDate('created_at', Carbon::today())
                                            ->first();

            $scheduledArrival = Carbon::parse($todaySchedule->time_start);
            $scheduledDeparture = Carbon::parse($todaySchedule->time_end);

            $now = Carbon::now();

            if (is_null($existingAttendance)) {
                if ($now->between($scheduledArrival->copy()->subMinutes(15), $scheduledArrival)) {
                    $arrivalStatus = 'Tepat Waktu';
                } elseif ($now->greaterThan($scheduledArrival)) {
                    $arrivalStatus = 'Terlambat';
                } else {
                    return response()->json(['error' => 'Anda tidak dapat mencatat kehadiran sekarang, anda dapat mencatat kedatangan 15 menit sebelum waktu yang ditentukan.'], 400);
                }

                $attendance = Attendance::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'role' => $role,
                    'type' => $type,
                    'arrival_at' => $now,
                    'status_arrival' => $arrivalStatus,
                ]);

                return response()->json([
                    'success' => 'Kedatangan berhasil dicatat.',
                    'arrival_at' => $attendance->arrival_at->toDateTimeString(),
                    'departure_at' => null,
                    'status_arrival' => $attendance->status_arrival,
                    'status_departure' => null
                ]);
            } else {
                if (!$existingAttendance->departure_at) {
                    if ($now->between($scheduledDeparture->copy()->subMinutes(30), $scheduledDeparture)) {
                        $departureStatus = 'Tepat Waktu';
                    } elseif ($now->greaterThan($scheduledDeparture)) {
                        $departureStatus = 'Terlambat';
                    } elseif ($now->greaterThan($scheduledDeparture->copy()->addHours(2))) {
                        return response()->json(['error' => 'Waktu absen kepulangan telah selesai.'], 400);
                    } else {
                        return response()->json(['error' => 'Anda tidak dapat mencatat kepulangan sekarang, anda dapat mencatat kepulangan 30 menit sebelum waktu yang ditentukan.'], 400);
                    }

                    $existingAttendance->departure_at = $now;
                    $existingAttendance->status_departure = $departureStatus;
                    $existingAttendance->save();

                    return response()->json([
                        'success' => 'Kepulangan berhasil dicatat.',
                        'arrival_at' => $existingAttendance->arrival_at->toDateTimeString(),
                        'departure_at' => $existingAttendance->departure_at->toDateTimeString(),
                        'status_arrival' => $existingAttendance->status_arrival,
                        'status_departure' => $departureStatus,
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Kedatangan dan kepulangan sudah dicatat untuk hari ini.',
                        'arrival_at' => $existingAttendance->arrival_at->toDateTimeString(),
                        'departure_at' => $existingAttendance->departure_at->toDateTimeString(),
                        'status_arrival' => $existingAttendance->status_arrival,
                        'status_departure' => $existingAttendance->status_departure,
                    ]);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Error in recordAttendance: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000;

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }
}
