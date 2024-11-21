<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('layout');
    })->name('home');
    Route::resource('user', UserController::class);
    Route::resource('post', PostController::class);
    Route::get('allPosts', [PostController::class, 'allPosts'])->name('allPosts');
});

Route::get('showRegisterForm', [AuthController::class, 'showRegisterForm'])->name('showRegisterForm');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, "showLoginForm"]);
Route::post('/login', [AuthController::class, "login"])->name('login');
Route::get('/logout', [AuthController::class, "logout"])->name('logout');



