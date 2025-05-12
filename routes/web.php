<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login.login');
});

Route::get('/', [BukuController::class, 'index']);
Route::get('/index', [BukuController::class, 'index']);
