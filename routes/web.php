<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DefaultPagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DefaultPagesController::class, 'index'])->name('welcome');
Route::get('/acasa', [DefaultPagesController::class, 'home'])->name('home');
Route::get('/cont', [AccountController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
