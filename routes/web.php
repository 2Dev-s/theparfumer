<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DefaultPagesController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DefaultPagesController::class, 'index'])->name('welcome');
Route::get('/home', [DefaultPagesController::class, 'home'])->name('home');
Route::get('/termeni-si-conditii', [DefaultPagesController::class, 'tos'])->name('tos');
Route::get('/politica-de-confidentialitate', [DefaultPagesController::class, 'pdc'])->name('pdc');

Route::match(['get', 'post'], '/perfumes', [DefaultPagesController::class, 'perfumes'])->name('perfumes');
Route::get('/perfume/{perfume:slug}', [DefaultPagesController::class, 'show'])->name('perfume.show');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'getCart']);
    Route::get('/view', [CartController::class, 'view'])->name('cart.view');
    Route::post('/add', [CartController::class, 'addToCart']);
    Route::put('/update/{productId}', [CartController::class, 'updateCart']);
    Route::delete('/remove/{productId}', [CartController::class, 'removeFromCart']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
