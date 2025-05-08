<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::redirect('settings', '/settings/profile')->name('dashboard');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('settings/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::put('settings/password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('settings/addresses', [AddressController::class, 'edit'])->name('addresses.edit');
    Route::post('settings/addresses/personal', [AddressController::class, 'updatePersonal'])->name('addresses.personal.update');
    Route::post('settings/addresses/company', [AddressController::class, 'updateCompany'])->name('addresses.company.update');
});
