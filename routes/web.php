<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::middleware(['guest'])->group(function () {
    Route::get('/signup', [AuthController::class, 'signupView']);
    Route::post('/signup', [AuthController::class, 'signup']);

    Route::get('/login', [AuthController::class, 'loginView']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout']);

    // Category
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::patch('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
});
