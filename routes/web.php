<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::get('signup', [AuthController::class, 'signupView']);
Route::post('signup', [AuthController::class, 'signup']);

Route::get('login', [AuthController::class, 'loginView']);
Route::post('login', [AuthController::class, 'login']);

Route::delete('logout', [AuthController::class, 'logout']);
