<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::middleware(['guest'])->group(function () {
    Route::get('/signup', [AuthController::class, 'signupView'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->middleware('throttle:3,1')->name('signup');

    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('throttle:10,1');
});

Route::middleware(['auth'])->group(function () {
    // Logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('can:admin-access')->group(function () {
        // Category
        Route::resource('categories', CategoryController::class)->except(['edit', 'create']);

        // Task
        Route::resource('tasks', TaskController::class)->except(['edit']);

        //Comments
        Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');

        // Users
        Route::resource('users', UserController::class)->except(['edit', 'create', 'store']);
        Route::get('/users/{user}/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
    });

    //TODO: authorization for these two
    Route::get('/users/{user}/tasks/{task}', [TaskController::class, 'nonAdminShow']);
    Route::patch('/users/{user}/tasks/{task}', [TaskController::class, 'nonAdminUpdate']);

    // Task Comments
    Route::post('/tasks/{task}/comments', [CommentController::class, 'storeTaskComment'])->name('tasks.comments.store');
    Route::patch('/tasks/{task}/comments/{comment}', [CommentController::class, 'updateTaskComment'])->name('tasks.comments.update');
    Route::delete('/tasks/{task}/comments/{comment}', [CommentController::class, 'destroyTaskComment'])->name('tasks.comments.destroy');
});
