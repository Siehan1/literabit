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
use App\Http\Controllers\misionTemplate;
use App\Http\Controllers\dailyMision; // Import dailyMision controller
use App\Http\Controllers\KuisController;

// route to landing page
Route::get('/', function () {
    return view('index');
});


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




// route to buku
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/uploadbuku', [AdminController::class, 'showUpload'])->name('upload');
Route::post('/uploadbuku', [BukuController::class, 'store'])->name('upload');
Route::get('/tableBuku', [BukuController::class, 'showBuku'])->name('tableBuku');
Route::delete('/hapus/{slug}', [BukuController::class, 'destroy'])->name('buku.destroy');

// route to genre
Route::get('tableGenre', [GenreController::class, 'index'])->name('tableGenre');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// router badges
Route::get('/uploadBadges',[badgesController::class,'indexUpload'])->name('Badges');
Route::post('/uploadBadges',[badgesController::class,'store'])->name('Badges');
Route::get('/tableBadges',[badgesController::class,'indexBadges'])->name('tableBadges');
Route::get('/tableBadges',[badgesController::class,'showBadges'])->name('tableBadges');

// Route untuk Kuis
Route::get('/admin/kuis', [quizController::class, 'index'])->name('tableKuis'); 
Route::get('/admin/kuis/create', [quizController::class, 'create'])->name('uploadKuis');
Route::post('/admin/kuis', [quizController::class, 'store'])->name('storeKuis'); 

// level treshold
Route::get('/uploadLevel',[LevelTresholdController::class,'create'])->name('uploadLevel');
Route::post('uploadLevel',[LevelTresholdController::class,'store'])->name('storeLevel');
Route::get('/tableLevel',[LevelTresholdController::class,'index'])->name('tableLevel');
Route::delete('/admin/level-tresholds/{levelTreshold}', [levelTresholdController::class, 'destroy'])->name('destroyLevel');

// mission
// mission template routes
Route::get('mision/template',[misionTemplate::class,'index'])->name('missionTemplate.index'); // Ganti nama route agar konsisten
Route::get('uploadTemplateMision',[misionTemplate::class,'create'])->name('missionTemplate.create'); // Ganti nama route
Route::post('uploadTemplateMission',[misionTemplate::class,'store'])->name('missionTemplate.store'); // Ganti nama route
Route::delete('/admin/mission-templates/{template}', [misionTemplate::class, 'destroy'])->name('missionTemplate.destroy'); // Ganti nama route

// Daily Mission Routes (Tambahkan ini)
// Route::resource('admin/daily-missions', dailyMision::class)->names([
//     'index' => 'dailyMission.index',
//     'create' => 'dailyMission.create',
//     'store' => 'dailyMission.store',
//     'show' => 'dailyMission.show',
//     'edit' => 'dailyMission.edit',
//     'update' => 'dailyMission.update',
//     'destroy' => 'dailyMission.destroy',
// ]);

Route::get('tableDaily',[dailyMision::class,'index'])->name('tableDaily');
Route::get('uploadDaily',[dailyMision::class,'create'])->name('uploadDaily');
Route::post('uploadDaily',[dailyMision::class,'store'])->name('uploadDaily');
Route::delete('/admin/daily-missions/{daily}', [dailyMision::class, 'destroy'])->name('deleteDaily'); 
// route dashboard admin
Route::get('/admin',function(){
    return view ('admin.admin');
});
Route::get('/uploadBuku', function(){
    return view('admin.uploadbuku');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

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

