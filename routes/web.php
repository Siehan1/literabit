<?php

use App\Http\Controllers\AsignmentMision;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KuisController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\badgesController;
use App\Http\Controllers\quizController;
use App\Http\Controllers\LevelTresholdController;
use App\Http\Controllers\misionTemplate;
use App\Http\Controllers\dailyMision;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\BacaBukuController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\achievmentsController;
use App\Http\Controllers\StreakController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\ResumeController;


// route to landing page



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
Route::middleware('auth')->group(function () {
    Route::get('/beranda',[BukuController::class, 'beranda'])->name('buku.beranda');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('admin');
});


// route to buku
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/tableBuku', [BukuController::class, 'showBuku'])->name('tableBuku');
    Route::get('/buku/upload', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku/upload', [BukuController::class, 'store'])->name('buku.store');
    Route::get('/buku/edit/{slug}', [BukuController::class, 'edit'])->name('buku.edit');
    Route::post('/buku/edit/{slug}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/hapus/{slug}', [BukuController::class, 'destroy'])->name('buku.destroy');
});

// route to genre
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('tableGenre', [GenreController::class, 'index'])->name('tableGenre');
    Route::get('/genre/tambah', [GenreController::class, 'create'])->name('genre.create');
    Route::post('/genre/tambah', [GenreController::class, 'store'])->name('genre.store');
    Route::get('/genre/edit/{id}', [GenreController::class, 'edit'])->name('genre.edit');
    Route::post('/genre/edit/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/genre/hapus/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');
});

// router badges
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/uploadBadges',[badgesController::class,'create'])->name('badge.create');
    Route::post('/uploadBadges',[badgesController::class,'store'])->name('badge.store');
    Route::get('/tableBadges',[badgesController::class,'index'])->name('tableBadges');
    Route::delete('/badges/{id}', [badgesController::class, 'destroy'])->name('badge.destroy');
    Route::get('/badges/{id}/edit', [badgesController::class, 'edit'])->name('badge.edit');
});


// Route untuk Kuis
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('tableKuis', [quizController::class, 'index'])->name('tableKuis');
    Route::get('/kuis/tambah', [quizController::class, 'create'])->name('kuis.create');
    Route::post('/kuis/tambah', [quizController::class, 'store'])->name('kuis.store');
    Route::get('/kuis/edit/{id}', [quizController::class, 'edit'])->name('kuis.edit');
    Route::post('/kuis/edit/{id}', [quizController::class, 'update'])->name('kuis.update');
    Route::delete('/kuis/hapus/{id}', [quizController::class, 'destroy'])->name('kuis.destroy');
});

// level treshold
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/tableLevel',[LevelTresholdController::class,'index'])->name('tableLevel');
    Route::get('/level/tambah',[LevelTresholdController::class,'create'])->name('level.create');
    Route::post('/level/tambah',[LevelTresholdController::class,'store'])->name('level.store');
    Route::get('/level/edit/{id}', [LevelTresholdController::class, 'edit'])->name('level.edit');
    Route::post('/level/edit/{id}', [LevelTresholdController::class, 'update'])->name('level.update');
    Route::delete('/level/hapus/{levelTreshold}', [levelTresholdController::class, 'destroy'])->name('destroyLevel');
});

// mission
// mission template routes
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('mision/template',[misionTemplate::class,'index'])->name('missionTemplate.index');
    Route::get('uploadTemplateMision',[misionTemplate::class,'create'])->name('missionTemplate.create');
    Route::post('uploadTemplateMission',[misionTemplate::class,'store'])->name('missionTemplate.store');
    Route::delete('/admin/mission-templates/{template}', [misionTemplate::class, 'destroy'])->name('missionTemplate.destroy');
    Route::get('/admin/mission-templates/{template}/edit', [misionTemplate::class, 'edit'])->name('missionTemplate.edit');
    Route::match(['put', 'post'], '/admin/mission-templates/{template}', [misionTemplate::class, 'update'])->name('missionTemplate.update');
});

// daily
Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('tableDaily',[dailyMision::class,'index'])->name('tableDaily');
    Route::get('uploadDaily',[dailyMision::class,'create'])->name('uploadDaily');
    Route::post('uploadDaily',[dailyMision::class,'store'])->name('uploadDaily');
    Route::delete('/admin/daily-missions/{daily}', [dailyMision::class, 'destroy'])->name('deleteDaily');
    Route::get('/admin/daily-missions/{daily}/edit', [dailyMision::class, 'edit'])->name('editDaily');
    Route::match(['put', 'post'], '/admin/daily-missions/{daily}', [dailyMision::class, 'update'])->name('updateDaily');
});


Route::middleware('auth')->group(function () {
    // route baca buku
    Route::get('/baca-buku/{slug}', [BacaBukuController::class, 'show'])->name('bacaBuku');
    Route::get('/baca-buku/{slug}/pdf', [BacaBukuController::class, 'getPdf'])->name('bacaBuku.pdf');
    Route::post('/baca-buku/progress', [BacaBukuController::class, 'updateProgress'])->name('bacaBuku.progress');

    // route to kuis
    Route::get('kuis/intro/{slug}',[KuisController::class, 'index'])->name('kuis.intro');
    Route::get('/kuis/soal/{slug}/{nomor}', [KuisController::class, 'tampilSoal'])->name('kuis.soal');
    Route::post('/kuis/jawab', [KuisController::class, 'prosesJawaban'])->name('kuis.jawab');
    Route::get('/kuis/hasil/{slug}', [KuisController::class, 'tampilHasil'])->name('kuis.hasil');
    Route::view('/kuis/gagal/{slug}', 'kuis.gagal')->name('kuis.gagal');
});

Route::middleware(['auth'])->group(function () {
    // route resume
    Route::get('/resume/{slug}', [ResumeController::class, 'index'])->name('resume');
    Route::post('/resume/{slug}', [ResumeController::class, 'store'])->name('resume.store');
});

// route profil
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::post('/profil/edit', [ProfilController::class, 'update'])->middleware('auth')->name('profile.update');
Route::post('/profil/edit/avatar', [ProfilController::class, 'updateAvatar'])->middleware('auth')->name('profile.avatar');


// Route History
Route::get('/history', [HistoryController::class, 'index'])->middleware('auth')->name('histori');
Route::get('/history/{type}', [HistoryController::class, 'show'])->middleware('auth')->name('histori.list');


// get mision assignment
Route::get('/Mission-Asignment', [AsignmentMision::class, 'showAll'])->middleware('auth')->name('index.Asignment');
Route::post('/Mission-Asignment-upload', [AsignmentMision::class,'store'])->middleware('auth')->name('store.Asignment');
Route::get('/Mission-Asigment-upload', [AsignmentMision::class,'create'])->middleware('auth')->name('create.Asignment');
Route::post('/record-reading/{userId}/{bookId}', [BacaBukuController::class, 'recordBookRead'])->name('record.book.read');


// pencapaian
Route::get('/pencapaian', [achievmentsController::class,'index'])->name('pencapaian.index');
Route::middleware('auth')->get('/pencapaian/badge', [achievmentsController::class, 'showAchievments'])->name('pencapaian.show');

// streak
Route::get('/streak',[StreakController::class,'streak'])->name('streak');

// leaderboard
Route::get('/leaderboad',[LeaderboardController::class,'index'])->name('leaderboard');
Route::get('/leaderboad-get',[LeaderboardController::class,'getLeaderboard'])->name('getLeaderboard');

// badge reward
    Route::get('/badge-reward', [badgesController::class, 'terimaBadge'])->name('badge.reward');
