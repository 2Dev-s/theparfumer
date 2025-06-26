<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DefaultPagesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DefaultPagesController::class, 'index'])->name('welcome');
Route::get('/home', [DefaultPagesController::class, 'home'])->name('home');
Route::get('/termeni-si-conditii', [DefaultPagesController::class, 'tos'])->name('tos');
Route::get('/politica-de-confidentialitate', [DefaultPagesController::class, 'pdc'])->name('pdc');
Route::get('/search', [DefaultPagesController::class, 'search'])->name('search');


Route::match(['get', 'post'], '/perfumes', [DefaultPagesController::class, 'perfumes'])->name('perfumes');
Route::match(['get', 'post'], '/room-perfumes', [DefaultPagesController::class, 'roomPerfumes'])->name('room-perfumes');
Route::get('/perfume/{perfume:slug}', [DefaultPagesController::class, 'perfum'])->name('perfume.show');
Route::get('/perfume-room/{perfume:slug}', [DefaultPagesController::class, 'perfumRoom'])->name('perfumeRoom.show');

Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
Route::post('/perfumes/{perfume}/favourite', [FavoritesController::class, 'toggleFavourite']);
Route::post('/discount/apply', [CartController::class, 'applyDiscount'])->name('discount.apply');

Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'getCart']);
    Route::get('/view', [CartController::class, 'view'])->name('cart.view');
    Route::post('/add', [CartController::class, 'addToCart']);
    Route::put('/update/{productId}', [CartController::class, 'updateCart']);
    Route::delete('/remove/{productId}', [CartController::class, 'removeFromCart']);
});

Route::post('/checkout', [StripeController::class, 'create'])->name('checkout.create');
Route::get('/checkout/success', [StripeController::class, 'success'])->name('checkout.success');
Route::get('/checkout/canceled', [StripeController::class, 'canceled'])->name('checkout.canceled');
Route::post('/checkout/ramburs', [StripeController::class, 'checkoutRamburs'])->name('checkout.cod');
Route::get('/checkout/success-ramburs/{order}', [StripeController::class, 'rambursSuccess'])->name('checkout.cod-success');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
