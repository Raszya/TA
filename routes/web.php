<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BabController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MapelGuruController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\NilaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth', 'verified');

//Routing Admin

Route::middleware(['auth', 'verified', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {

    // List Siswa
    Route::get('/listsiswa', [SiswaController::class, 'index'])->name('listsiswa');
    Route::get('downloaddatasiswa', [SiswaController::class, 'download'])->name('downloaddatasiswa');
    Route::post('uploaddatasiswa', [SiswaController::class, 'upload'])->name('uploaddatasiswa');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/{nis}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{nis}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::post('/siswa', [SiswaController::class, 'destroy'])->name('siswa.destroy');

    //  List Guru
    Route::get('/listguru', [GuruController::class, 'index'])->name('listguru');
    Route::get('downloaddataguru', [GuruController::class, 'download'])->name('downloaddataguru');
    Route::post('uploaddataguru', [GuruController::class, 'upload'])->name('uploaddataguru');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/{nomer_induk}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{nomer_induk}', [GuruController::class, 'update'])->name('guru.update');
    Route::post('/guru', [GuruController::class, 'destroy'])->name('guru.destroy');

    // List User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/delete', [UserController::class, 'destroy'])->name('users.delete');

    // List Mapel
    Route::get('/mapels', [MapelController::class, 'index'])->name('mapel');
});

//Routing Guru

Route::middleware(['auth', 'verified', 'role:guru'])->name('guru.')->prefix('guru')->group(function () {

    //  Mapel
    Route::get('/mapel', [MapelGuruController::class, 'index'])->name('mapel');
    Route::get('/mapel/create', [MapelGuruController::class, 'create'])->name('mapel.create');
    Route::post('/mapel/store', [MapelGuruController::class, 'store'])->name('mapel.store');
    Route::get('/mapel/{id_mapel}/edit', [MapelGuruController::class, 'edit'])->name('mapel.edit');
    Route::put('/mapel/{id_mapel}', [MapelGuruController::class, 'update'])->name('mapel.update');

    // Bab
    Route::get('/bab/{id}', [BabController::class, 'index'])->name('bab');
    Route::get('/bab/{id}/create', [BabController::class, 'create'])->name('bab.create');
    Route::post('/bab/{id}/store', [BabController::class, 'store'])->name('bab.store');
    Route::get('/bab/{id}/edit', [BabController::class, 'edit'])->name('bab.edit');
    Route::put('/bab/{id}', [BabController::class, 'update'])->name('bab.update');
    Route::delete('/bab/{id}', [BabController::class, 'destroy'])->name('bab.destroy');
    Route::get('/penilaian/{id}', [JawabanController::class, 'penilaian'])->name('penilaian');
    Route::post('/penilaian/store/{id}', [JawabanController::class, 'storeNilai'])->name('penilaian.store');

    // Tugas
    Route::get('/bab/tugas/{id}', [TugasController::class, 'index'])->name('tugas');
    Route::get('/bab/{id}/tugas/create}', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/bab/{id}/tugas/store', [TugasController::class, 'store'])->name('tugas.store');

    // Modul
    Route::get('/bab/{id}/modul/create}', [ModulController::class, 'create'])->name('modul.create');
    Route::post('/bab/{id}/modul/store', [ModulController::class, 'store'])->name('modul.store');
    // Route::get('/bab/{id}/modul/{id1}/showPdf', [TugasController::class, 'getPdf'])->name('modul.showpdf');
});
//Routing Siswa

Route::middleware(['auth', 'verified', 'role:siswa'])->name('siswa.')->prefix('siswa')->group(function () {
    // 
    Route::get('/listMapel', [SiswaController::class, 'getListMapel'])->name('listMapel');
    Route::get('/enrollment/{id}', [SiswaController::class, 'enrollment'])->name('enrollment');
    Route::post('/enrollment/{id}/store', [SiswaController::class, 'enrollmentstore'])->name('enrollment.store');
    Route::get('/mapel/{id}/bab', [BabController::class, 'indexSiswa'])->name('bab');
    Route::get('/bab/tugas/{id}', [TugasController::class, 'indexSiswa'])->name('tugas');
    Route::post('/bab/tugas/jawaban/{id}', [JawabanController::class, 'store'])->name('jawaban');
    Route::get('/nilai', [JawabanController::class, 'nilai'])->name('nilai');
});

require __DIR__ . '/auth.php';
