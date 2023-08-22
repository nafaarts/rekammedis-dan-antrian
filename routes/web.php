<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPoliController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\BuatAntrianController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PendaftaranPasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfileController;
use App\Models\AdminPoli;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('beranda');
})->name('beranda');

Route::get('/dashboard', function () {
    $jumlahPoli = Poli::count();
    $jumlahDokter = Dokter::count();
    $jumlahPasien = Pasien::count();
    $jumlahAdminPoli = AdminPoli::count();

    return view('admin.dashboard', compact('jumlahPoli', 'jumlahDokter', 'jumlahPasien', 'jumlahAdminPoli'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/buat-antrian', function () {
    return view('antrian.buat-antrian');
})->name('buat-antrian');
Route::post('/buat-antrian', BuatAntrianController::class)->name('buat-antrian');

Route::middleware('auth')->group(function () {

    Route::middleware('can:is_pasien')->group(function () {
        // pasien
        Route::get('/pendaftaran/pasien/formulir', [PendaftaranPasienController::class, 'formulir'])->name('pendaftaran.formulir');
        Route::post('/pendaftaran/pasien/formulir', [PendaftaranPasienController::class, 'storeFormulir'])->name('pendaftaran.store-formulir');

        // riwayat penyakit pasien
        Route::get('/pendaftaran/pasien/riwayat-penyakit', [PendaftaranPasienController::class, 'riwayatPenyakit'])->name('pendaftaran.riwayat-penyakit');
        Route::post('/pendaftaran/pasien/riwayat-penyakit', [PendaftaranPasienController::class, 'storeRiwayatPenyakit'])->name('pendaftaran.store-riwayat-penyakit');

        // riwayat jadwal kunjungan
        Route::get('/pendaftaran/pasien/jadwal-kunjungan', [PendaftaranPasienController::class, 'jadwalKunjungan'])->name('pendaftaran.jadwal-kunjungan');
        Route::post('/pendaftaran/pasien/jadwal-kunjungan', [PendaftaranPasienController::class, 'storeJadwalKunjungan'])->name('pendaftaran.store-jadwal-kunjungan');

        // bukti pendaftaran
        Route::get('/pendaftaran/pasien/bukti_pendaftaran', [PendaftaranPasienController::class, 'bukti'])->name('pendaftaran.bukti');

        // antrian
        Route::get('/antrian-saya', function () {
            $pasien = Pasien::where('user_id', auth()->id())->first();
            $antrian = Antrian::whereHas('kunjungan', function ($query) use ($pasien) {
                $query->where('pasien_id', $pasien->id);
            })
                ->where('status_antrian', 0)
                ->latest()->first();

            return view('antrian.antrian-saya', compact('antrian'));
        })->name('antrian-saya');
    });

    Route::middleware('can:is_admin')->group(function () {
        // admin
        Route::resource('poli', PoliController::class)->except('show');
        Route::resource('poli.admin-poli', AdminPoliController::class)->except('show')->parameters([
            'admin-poli' => 'admin'
        ]);
        Route::resource('dokter', DokterController::class);
        Route::resource('pasien', PasienController::class)->except('show');

        Route::resource('admin', AdminController::class)->except('show')->parameters([
            'admin' => 'user'
        ]);

        Route::delete('antrian/reset', [AntrianController::class, 'reset'])->name('antrian.reset');
    });

    Route::middleware('can:is_admin_and_poli')->group(function () {
        Route::get('pasien/{pasien}', [PasienController::class, 'show'])->name('pasien.show');
        Route::get('pasien/{pasien}/rekammedis/{rekammedis}', [PasienController::class, 'detailRekamMedis'])->name('pasien.detail-rekammedis');

        Route::get('kunjungan', [KunjunganController::class, 'index'])->name('kunjungan.index');
        Route::get('kunjungan/{kunjungan}/detail', [KunjunganController::class, 'detail'])->name('kunjungan.detail');

        Route::get('kunjungan/{kunjungan}/periksa', [PemeriksaanController::class, 'periksa'])->name('kunjungan.periksa');
        Route::post('kunjungan/{kunjungan}/periksa', [PemeriksaanController::class, 'storePeriksa'])->name('kunjungan.storePeriksa');

        Route::get('antrian', [AntrianController::class, 'index'])->name('antrian.index');
        Route::get('antrian/{antrian}/toggle', [AntrianController::class, 'togglePemanggilan'])->name('antrian.update');
    });

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
