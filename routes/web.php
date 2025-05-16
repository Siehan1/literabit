<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// route to landing page
Route::get('/', function () {
    return view('index');
});

// route to login
Route::get('/login', function () {
    return view('login.login');
});

// route to beranda
Route::get('/beranda',function (){
    return view('beranda.beranda');
});

// route to get data users
Route::get('/beranda', [UserController::class, 'index']);
// route to get data buku
Route::get('/', [BukuController::class, 'index']);
Route::get('/index', [BukuController::class, 'index']);

// auth login
Route::get('/login',[AuthController::class,'showlogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/beranda', [UserController::class, 'beranda'])->middleware('auth');
