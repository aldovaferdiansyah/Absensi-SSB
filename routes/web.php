<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ScannerSettingsController;

// Data Student, DataPelatih dan QrCode
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QrCodeController;

// Data Profile
use App\Http\Controllers\ProfileController;

// Data Akun User
use App\Http\Controllers\UserController;

// Rekap absensi
use App\Http\Controllers\AttendanceController;

// Halaman awal rekap
use App\Http\Controllers\RekapizinController;
use App\Http\Controllers\PengajuanizinController;

// Scanner absensi
use App\Http\Controllers\QRScannerController;

// Halaman informasi
use App\Http\Controllers\InformationController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/v_home',[HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('v_home');
// Route untuk menampilkan halaman dashboard
Route::get('/dashboard.v_dashboard',[DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('v_dashboard');
// Route untuk menampilkan halaman rekap perizinan absen
Route::get('/rekap.v_rekapizin', [RekapizinController::class, 'index'])->middleware(['auth', 'verified'])->name('rekapizin.index');
// Route untuk menampilkan rekap absensi Siswa
Route::get('/attendances/absenSiswa', [StudentController::class, 'showAbsenSiswa'])->middleware(['auth', 'verified'])->name('attendances.absenSiswa');

// Hak akses admin
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Route Data Akun User
    Route::get('/users',[UserController::class, 'index'])->name('users.index');
    // Route untuk menampilkan halaman tambah pelatih
    Route::get('/users/create',[UserController::class, 'create'])->name('users.create');
    // Route untuk menyimpan data pelatih
    Route::post('/users',[UserController::class, 'store'])->name('users.store');
    // Route untuk menampilkan halaman edit pelatih
    Route::get('/users/{id}/edit',[UserController::class, 'edit'])->name('users.edit');
    // Route untuk mengupdate data pelatih
    Route::put('/users/{id}',[UserController::class, 'update'])->name('users.update');
    // Route untuk menghapus data pelatih
    Route::delete('/users/{id}',[UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/generate-user-qr-codes', [QrCodeController::class, 'generateForUsers'])->name('generate.user.qr.codes');
    // Routing untuk QR Code Pelatih
    Route::get('/pelatih/qr-code/{id}', [PelatihController::class, 'qrCode'])->name('pelatih.qr-code');
    // Routing untuk QR Code Siswa
    Route::get('/student/qr-code/{id}', [StudentController::class, 'qrCode'])->name('student.qr-code');

    // New routes for settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});


// Hak akses pelatih
Route::middleware(['auth', 'verified', 'role:pelatih'])->group(function () {

    // Crud Jadwal Informasi
    // Route untuk menampilkan halaman tambah Informasi
    Route::get('/information/create', [InformationController::class, 'create'])->name('information.create');
    // Route untuk menyimpan data informasi
    Route::post('/information', [InformationController::class, 'store'])->name('information.store');
    // Route untuk menampilkan halaman edit informasi
    Route::get('/information/{id}/edit', [InformationController::class, 'edit'])->name('information.edit');
    // Route untuk mengupdate data informasi
    Route::put('/information/{id}', [InformationController::class, 'update'])->name('information.update');
    // Route untuk menghapus data informasi
    Route::delete('/information/{id}', [InformationController::class, 'destroy'])->name('information.destroy');

    Route::get('/settingscanner', [ScannerSettingsController::class, 'index'])->name('settingscanner');
    Route::post('/settingscanner/update', [ScannerSettingsController::class, 'updateSettings'])->name('settingscanner.update');



});

// Hak akses pelatih dan admin
Route::middleware(['auth', 'verified', 'role:pelatih|admin'])->group(function () {
    // Route untuk menampilkan halaman daftar siswa
    Route::get('/students.index', [StudentController::class, 'index'])->name('students.index');
    // Rute untuk menampilkan halaman detail siswa
    Route::get('/siswa/detail/{id}',[StudentController::class, 'detail']);

    Route::get('/validasi-izin', [PengajuanizinController::class, 'validateIndex'])->name('izin.validate.index');
    Route::post('/validasi-izin/{id}', [PengajuanizinController::class, 'validateRequest'])->name('izin.validate');

    // Route untuk menampilkan rekap absensi Pelatih
    Route::get('/attendances/absenPelatih', [PelatihController::class, 'showAbsenPelatih'])->name('attendances.absenPelatih');
});


// Hak akses siswa dan admin
Route::middleware(['auth', 'verified', 'role:siswa|admin'])->group(function () {
    // Route untuk menampilkan halaman daftar pelatih
    Route::get('/pelatih.index',[PelatihController::class, 'index'])->name('pelatih.index');
    // Rute untuk menampilkan halaman detail pelatih
    Route::get('/pelatih/detail/{id}',[PelatihController::class, 'detail']);
});

// Hak akses siswa
Route::middleware(['auth', 'verified', 'role:siswa'])->group(function () {
    // Route untuk menampilkan halaman Pengajuan Izin
    Route::get('/permission.pengajuanizin', [PengajuanizinController::class, 'index'])->name('pengajuanizin.index');
    // Route untuk menyimpan data pengajuan izin
    Route::post('/permission.pengajuanizin', [PengajuanizinController::class, 'store'])->name('izin.submit');
});

// Hak akses siswa dan pelatih
Route::middleware(['auth', 'verified', 'role:siswa|pelatih'])->group(function () {
    // Route untuk menampilkan halaman scanner absensi
    Route::get('/scanner.scannerAbsensi', [QrScannerController::class, 'index'])->name('scanner.scannerAbsensi');
    // Route untuk menyimpan data absensi
    Route::post('/scanner.attendance.store', [QrScannerController::class, 'storeAttendance'])->name('scanner.attendance.store');
    // Route untuk menampilkan halaman informasi
    Route::get('/information.v_information', [InformationController::class, 'index'])->name('informasi.index');
    Route::get('/information', [InformationController::class, 'index'])->name('information.index');
    // Route untuk menampilkan halaman profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    // Route untuk menampilkan halaman form edit profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route untuk menyimpan hasil edit data profile
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // Route untuk menampilkan formulir ubah password
    Route::get('/profile/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('profile.change-password');
    // Route untuk memproses perubahan password
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password.post');

    Route::get('scanner/coordinates', [QrScannerController::class, 'getCoordinates'])->name('scanner.coordinates');

});

require __DIR__.'/auth.php';
