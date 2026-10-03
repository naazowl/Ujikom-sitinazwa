<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\InformasiController as AdminInformasiController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\JurusanController as AdminJurusanController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\PesanController as AdminPesanController;
use App\Http\Controllers\GaleriLikeController;


Route::get('/', [HomeController::class, 'index']);
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/informasi/semua', [InformasiController::class, 'semua'])->name('informasi.semua');
Route::get('/informasi/kategori/{kategori}', [InformasiController::class, 'kategori'])->name('informasi.kategori');
Route::get('/informasi/{slug}', [InformasiController::class, 'show'])->name('informasi.show');
Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
Route::get('/jurusan/{kode}', [JurusanController::class, 'show'])->name('jurusan.show');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/kategori/{kategori}', [ProdukController::class, 'kategori'])->name('produk.kategori');
Route::get('/produk/{slug}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post')->middleware('throttle:5,1');
Route::get('/galeri/likes', [GaleriLikeController::class, 'index'])->name('galeri.likes');
Route::post('/galeri/{galeri}/like', [GaleriLikeController::class, 'toggle'])->name('galeri.like');

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/informasi', [AdminInformasiController::class, 'index'])->name('informasi.index');
    Route::get('/informasi/tambah', [AdminInformasiController::class, 'create'])->name('informasi.create');
    Route::get('/informasi/{id}/edit', [AdminInformasiController::class, 'edit'])->name('informasi.edit');
    Route::post('/informasi', [AdminInformasiController::class, 'store'])->name('informasi.store');
    Route::put('/informasi/{id}', [AdminInformasiController::class, 'update'])->name('informasi.update');
    Route::delete('/informasi/{id}', [AdminInformasiController::class, 'destroy'])->name('informasi.destroy');


    Route::get('/galeri', [AdminGaleriController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/tambah', [AdminGaleriController::class, 'create'])->name('galeri.create');
    Route::get('/galeri/{id}/edit', [AdminGaleriController::class, 'edit'])->name('galeri.edit');
    Route::post('/galeri', [AdminGaleriController::class, 'store'])->name('galeri.store');
    Route::put('/galeri/{id}', [AdminGaleriController::class, 'update'])->name('galeri.update');
    Route::delete('/galeri/{id}', [AdminGaleriController::class, 'destroy'])->name('galeri.destroy');


    Route::get('/jurusan', [AdminJurusanController::class, 'index'])->name('jurusan.index');
    Route::get('/jurusan/tambah', [AdminJurusanController::class, 'create'])->name('jurusan.create');
    Route::get('/jurusan/{id}/edit', [AdminJurusanController::class, 'edit'])->name('jurusan.edit');
    Route::post('/jurusan', [AdminJurusanController::class, 'store'])->name('jurusan.store');
    Route::put('/jurusan/{id}', [AdminJurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{id}', [AdminJurusanController::class, 'destroy'])->name('jurusan.destroy');


    Route::get('/produk', [AdminProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/tambah', [AdminProdukController::class, 'create'])->name('produk.create');
    Route::get('/produk/{id}/edit', [AdminProdukController::class, 'edit'])->name('produk.edit');
    Route::post('/produk', [AdminProdukController::class, 'store'])->name('produk.store');
    Route::put('/produk/{id}', [AdminProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [AdminProdukController::class, 'destroy'])->name('produk.destroy');

    Route::get('/pesan', [AdminPesanController::class, 'index'])->name('pesan.index');
    Route::patch('/pesan/{id}/baca', [AdminPesanController::class, 'baca'])->name('pesan.baca');
    Route::delete('/pesan/{id}', [AdminPesanController::class, 'destroy'])->name('pesan.destroy');
});