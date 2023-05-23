<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

//Routing Admin

Route::middleware(['auth', 'verified', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/listsiswa', [SiswaController::class, 'index'])->name('listsiswa');
    Route::get('/listguru', [GuruController::class, 'index'])->name('listguru');
    Route::get('downloaddatasiswa', [SiswaController::class, 'download'])->name('downloaddatasiswa');
    Route::post('uploaddatasiswa', [SiswaController::class, 'upload'])->name('uploaddatasiswa');
    Route::get('downloaddataguru', [GuruController::class, 'download'])->name('downloaddataguru');
    Route::post('uploaddataguru', [GuruController::class, 'upload'])->name('uploaddataguru');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/mapels', [MapelController::class, 'index'])->name('mapel');
});

//Routing Guru

//Routing Siswa

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
});



require __DIR__ . '/auth.php';
