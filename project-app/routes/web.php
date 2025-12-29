<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ForumCategoryController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
         ->name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    // CREATE category (static) — must come first
    Route::get('/categories/create', [ForumCategoryController::class, 'create'])
        ->name('categories.create');

    Route::post('/categories', [ForumCategoryController::class, 'store'])
        ->name('categories.store');

    // SHOW category (dynamic) — comes last
    Route::get('/categories/{category}', [ForumCategoryController::class, 'show'])
         ->name('categories.show');

});



Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
