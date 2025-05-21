<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\badgesController;
use App\Http\Controllers\quizController; 

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

// router badges
Route::get('/uploadBadges',[badgesController::class,'indexUpload'])->name('Badges');
Route::post('/uploadBadges',[badgesController::class,'store'])->name('Badges');
Route::get('/tableBadges',[badgesController::class,'indexBadges'])->name('tableBadges');
Route::get('/tableBadges',[badgesController::class,'showBadges'])->name('tableBadges');

// Route untuk Kuis
Route::get('/admin/kuis', [quizController::class, 'index'])->name('tableKuis'); // Rute untuk menampilkan daftar kuis
Route::get('/admin/kuis/create', [quizController::class, 'create'])->name('uploadKuis'); // Rute untuk form tambah kuis
Route::post('/admin/kuis', [quizController::class, 'store'])->name('storeKuis'); // Rute untuk menyimpan kuis

