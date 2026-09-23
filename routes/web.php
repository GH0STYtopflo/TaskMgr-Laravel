<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
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

    // Task
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/tasks/create', [TaskController::class, 'create']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::patch('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);

    Route::get('/dashboard', [MiscController::class, 'dashboard']);

    //TODO: authorization for these two
    Route::get('/users/{users}/tasks/{task}', [TaskController::class, 'nonAdminShow']);
    Route::patch('/users/{users}/tasks/{task}', [TaskController::class, 'nonAdminUpdate']);

    // Comments
    Route::post('/tasks/{task}/comments', [TaskController::class, 'storeTaskComment']);
    Route::patch('/tasks/{task}/comments/{comment}', [TaskController::class, 'updateTaskComment']);
    Route::delete('/tasks/{task}/comments/{comment}', [TaskController::class, 'destroyTaskComment']);
    Route::get('/comments', [CommentController::class, 'index']);

    // Users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::patch('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});
