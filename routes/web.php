<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\GenreController;

// route to landing page
Route::get('/', function () {
    return view('index');
});

// route to login
// Route::get('/login', function () {
//     return view('login.login');
// });

// route to beranda
// Route::get('/beranda',function (){
//     return view('beranda.beranda');
// });

// route to get data users
// Route::get('/beranda', [UserController::class, 'index']);
// route to get data buku
Route::get('/', [BukuController::class, 'index']);
Route::get('/index', [BukuController::class, 'index']);

// auth login
Route::get('/login',[AuthController::class,'showlogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/beranda', [UserController::class, 'beranda'])->middleware('auth');

// register
Route::get('/register', [AuthController::class, 'showRegist'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// route dashboard admin
// Route::get('/admin',function(){
//     return view ('admin.admin');
// });
// Route::get('/uploadBuku', function(){
//     return view('admin.uploadbuku');
// });
Route::get('/admin', [AdminController::class, 'index'])->name('admin');


Route::get('/uploadbuku', [AdminController::class, 'showUpload'])->name('upload');
Route::post('/uploadbuku', [BukuController::class, 'store'])->name('upload');
Route::get('/tableBuku', [BukuController::class, 'showBuku'])->name('tableBuku');
Route::delete('/hapus/{slug}', [BukuController::class, 'destroy'])->name('buku.destroy');

Route::get('tableGenre', [GenreController::class, 'index'])->name('tableGenre');


Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// route kuis
// Route::get('/kuis/intro/{id_buku}', [KuisController::class, 'intro'])->name('kuis.intro');
// Route::get('/kuis/{id_buku}', [KuisController::class, 'show'])->name('kuis.mulai');

// Route::get('/kuis/{id_buku}/soal/{nomor}', [KuisController::class, 'tampilSoal'])->name('kuis.next');

// Route::get('/kuis/{id_buku}/hasil', [KuisController::class, 'tampilHasil'])->name('kuis.hasil');
// Route::get('/kuis/{id_buku}/gagal', [KuisController::class, 'gagal'])->name('kuis.gagal');

// Route::post('/api/kuis/jawab', [KuisController::class, 'submitJawaban'])->name('api.kuis.jawab');

// Route::get('/kuis/{id_buku}/hasil', [KuisController::class, 'tampilHasil'])->name('kuis.hasil');

// Route::get('/kuis/{id_buku}/gagal', [KuisController::class, 'gagal'])->name('kuis.gagal');

Route::get('/kuis/soal/{id_buku}/{nomor}', [KuisController::class, 'tampilSoal'])->name('kuis.soal');
Route::view('/kuis/intro', 'kuis.intro');

