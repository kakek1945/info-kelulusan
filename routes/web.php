<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraduationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', [GraduationController::class, 'index'])->name('home');
Route::post('/check', [GraduationController::class, 'check'])->name('check');

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Panel
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/template', [AdminController::class, 'downloadTemplate'])->name('template');
    Route::post('/upload', [AdminController::class, 'upload'])->name('upload');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/', [AdminController::class, 'store'])->name('store');
    Route::get('/{student}/edit', [AdminController::class, 'edit'])->name('edit');
    Route::put('/{student}', [AdminController::class, 'update'])->name('update');
    Route::delete('/{student}', [AdminController::class, 'destroy'])->name('destroy');
});
