<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectPostController;
use App\Http\Controllers\ContactController;

// Public Site
Route::get('/', function () {
    return view('site.home');
})->name('home');

Route::get('/about', function () {
    return view('site.about');
})->name('about');

Route::get('/posts', [ProjectPostController::class, 'publicList'])->name('posts.list');
Route::get('/posts/{slug}', [ProjectPostController::class, 'publicSingle'])->name('posts.single');

// Contact form (optional)
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Admin Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

    // Posts management
    Route::get('/posts', [ProjectPostController::class, 'index'])->name('admin.posts');
    Route::get('/posts/create', [ProjectPostController::class, 'create'])->name('admin.posts.create');
    Route::post('/posts', [ProjectPostController::class, 'store'])->name('admin.posts.store');
    Route::get('/posts/{id}/edit', [ProjectPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/posts/{id}', [ProjectPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/posts/{id}', [ProjectPostController::class, 'destroy'])->name('admin.posts.delete');

    // Contacts management (optional)
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.delete');
});
