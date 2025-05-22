<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\badgesController;
use App\Http\Controllers\quizController; 
use App\Http\Controllers\LevelTresholdController;

// route to landing page
Route::get('/', function () {
    return view('index');
});


Route::get('/', [BukuController::class, 'index']);
Route::get('/index', [BukuController::class, 'index']);


// auth login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegist'])->name('register.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// hanya user yang sudah login bisa akses ini
Route::get('/beranda', [UserController::class, 'beranda'])->middleware('auth');
Route::get('/beranda',[BukuController::class, 'BerandaBook'])->name('buku.beranda');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');




// route to buku
Route::get('/tableBuku', [BukuController::class, 'showBuku'])->name('tableBuku');
Route::get('/buku/upload', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku/upload', [BukuController::class, 'store'])->name('buku.store');
Route::get('/buku/edit/{slug}', [BukuController::class, 'edit'])->name('buku.edit');
Route::post('/buku/edit/{slug}', [BukuController::class, 'update'])->name('buku.update');
Route::delete('/buku/hapus/{slug}', [BukuController::class, 'destroy'])->name('buku.destroy');

// route to genre
Route::get('tableGenre', [GenreController::class, 'index'])->name('tableGenre');
Route::get('/genre/tambah', [GenreController::class, 'create'])->name('genre.create');
Route::post('/genre/tambah', [GenreController::class, 'store'])->name('genre.store');
Route::get('/genre/edit/{id}', [GenreController::class, 'edit'])->name('genre.edit');
Route::post('/genre/edit/{id}', [GenreController::class, 'update'])->name('genre.update');
Route::delete('/genre/hapus/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');

// router badges
Route::get('/tableBadges',[badgesController::class,'index'])->name('tableBadges');
Route::get('/badge/tambah',[badgesController::class,'create'])->name('badge.create');
Route::post('/badge/tambah',[badgesController::class,'store'])->name('badge.store');
Route::get('/badge/edit/{id}', [badgesController::class, 'edit'])->name('badge.edit');
Route::post('/badge/edit/{id}', [badgesController::class, 'update'])->name('badge.update');
Route::delete('/badge/hapus/{id}', [badgesController::class, 'destroy'])->name('badge.destroy');

// Route untuk Kuis
Route::get('tableKuis', [quizController::class, 'index'])->name('tableKuis'); 
Route::get('/kuis/tambah', [quizController::class, 'create'])->name('kuis.create');
Route::post('/kuis/tambah', [quizController::class, 'store'])->name('kuis.store');
Route::get('/kuis/edit/{id}', [quizController::class, 'edit'])->name('kuis.edit');
Route::post('/kuis/edit/{id}', [quizController::class, 'update'])->name('kuis.update');
Route::delete('/kuis/hapus/{id}', [quizController::class, 'destroy'])->name('kuis.destroy');

// level treshold
Route::get('/tableLevel',[LevelTresholdController::class,'index'])->name('tableLevel');
Route::get('/level/tambah',[LevelTresholdController::class,'create'])->name('level.create');
Route::post('/level/tambah',[LevelTresholdController::class,'store'])->name('level.store');
Route::get('/level/edit/{id}', [LevelTresholdController::class, 'edit'])->name('level.edit');
Route::post('/level/edit/{id}', [LevelTresholdController::class, 'update'])->name('level.update');
Route::delete('/level/hapus/{levelTreshold}', [levelTresholdController::class, 'destroy'])->name('destroyLevel');

// mission
// mission template routes
Route::get('mision/template',[misionTemplate::class,'index'])->name('missionTemplate.index'); 
Route::get('uploadTemplateMision',[misionTemplate::class,'create'])->name('missionTemplate.create'); 
Route::post('uploadTemplateMission',[misionTemplate::class,'store'])->name('missionTemplate.store'); 
Route::delete('/admin/mission-templates/{template}', [misionTemplate::class, 'destroy'])->name('missionTemplate.destroy'); 
Route::get('/admin/mission-templates/{template}/edit', [misionTemplate::class, 'edit'])->name('missionTemplate.edit');
Route::match(['put', 'post'], '/admin/mission-templates/{template}', [misionTemplate::class, 'update'])->name('missionTemplate.update');

// daily
Route::get('tableDaily',[dailyMision::class,'index'])->name('tableDaily');
Route::get('uploadDaily',[dailyMision::class,'create'])->name('uploadDaily');
Route::post('uploadDaily',[dailyMision::class,'store'])->name('uploadDaily');
Route::delete('/admin/daily-missions/{daily}', [dailyMision::class, 'destroy'])->name('deleteDaily');
Route::get('/admin/daily-missions/{daily}/edit', [dailyMision::class, 'edit'])->name('editDaily');
Route::match(['put', 'post'], '/admin/daily-missions/{daily}', [dailyMision::class, 'update'])->name('updateDaily'); 

// route dashboard admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin');




// route to kuis
Route::get('/kuis/soal/{slug}/{nomor}', [KuisController::class, 'tampilSoal'])->name('kuis.soal');
Route::post('/kuis/jawab', [KuisController::class, 'prosesJawaban'])->name('kuis.jawab');

Route::view('/kuis/intro', 'kuis.intro');
Route::get('/kuis/{id_buku}/gagal', [KuisController::class, 'gagal'])
    ->name('kuis.gagal');




Route::get('/profil', function () {
    return view('profil.index');
})->name('profil');



Route::get('/profil', [ProfilController::class, 'index'])->name('profil');Route::view('/kuis/hasil', 'kuis.hasil');
Route::view('/kuis/gagal/{slug}', 'kuis.gagal')->name('kuis.gagal');

// Route untuk Kuis
Route::get('/admin/kuis', [quizController::class, 'index'])->name('tableKuis'); 
Route::get('/admin/kuis/create', [quizController::class, 'create'])->name('uploadKuis');
Route::post('/admin/kuis', [quizController::class, 'store'])->name('storeKuis'); 

// level treshold
Route::get('/uploadLevel',[LevelTresholdController::class,'create'])->name('uploadLevel');
Route::post('uploadLevel',[LevelTresholdController::class,'store'])->name('storeLevel');
Route::get('/tableLevel',[LevelTresholdController::class,'index'])->name('tableLevel');
Route::delete('/admin/level-tresholds/{levelTreshold}', [levelTresholdController::class, 'destroy'])->name('destroyLevel');
