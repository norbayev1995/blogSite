<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout');
});
Route::resource('user', UserController::class);

Route::get('register', function (){
    return view('auth.register');
});
