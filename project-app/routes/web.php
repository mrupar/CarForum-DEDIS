<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\ForumCategoryController;
use App\Http\Controllers\ForumThreadController;
use App\Http\Controllers\ForumPostController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
         ->name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    // Categories
    Route::get('/categories/create', [ForumCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [ForumCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [ForumCategoryController::class, 'show'])->name('categories.show');
    Route::get('{category}/edit', [ForumCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('{category}', [ForumCategoryController::class, 'updateCategory'])->name('categories.update');
    Route::delete('{category}', [ForumCategoryController::class, 'destroyCategory'])->name('categories.destroy');
    // Threads
    Route::get('/categories/{category}/threads/create', [ForumThreadController::class, 'create'])->name('threads.create');
    Route::post('/categories/{category}/threads', [ForumThreadController::class, 'store'])->name('threads.store');
    Route::get('/threads/{thread}', [ForumThreadController::class, 'show'])->name('threads.show');
    Route::get('{thread}/edit', [ForumThreadController::class, 'edit'])->name('threads.edit');
    Route::put('threads/{thread}', [ForumThreadController::class, 'updateThread'])->name('threads.update');
    Route::delete('threads/{thread}', [ForumThreadController::class, 'destroyThread'])->name('threads.destroy');
    // Posts
    Route::post('/threads/{thread}/posts', [ForumPostController::class, 'store'])->name('posts.store');
});

// Authentication routes
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
