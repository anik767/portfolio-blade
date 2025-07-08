<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectPostController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Public Routes (No Auth Required)
|--------------------------------------------------------------------------
*/

// Public Project Posts — no middleware needed
Route::get('/project-posts', [ProjectPostController::class, 'index']);


// Contact submit (public)

Route::post('/contact', [ContactController::class, 'submit']);
/*
|--------------------------------------------------------------------------
| Web Routes (Session + CSRF required, no auth)
|--------------------------------------------------------------------------
*/

// Login route — needs 'web' middleware for session and CSRF cookies
Route::middleware('web')->post('/login', [AuthController::class, 'login'])->name('login');

/*
|--------------------------------------------------------------------------
| Protected Routes (Require Sanctum Auth + Web middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['web', 'auth:sanctum'])->prefix('admin')->group(function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);

    // Authenticated user info
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/password-reset', [AuthController::class, 'resetPassword']);
    // Project Posts CRUD for authenticated users
    Route::get('/project-posts/{id}', [ProjectPostController::class, 'show']);
    Route::post('/project-posts', [ProjectPostController::class, 'store']);
    Route::put('/project-posts/{id}', [ProjectPostController::class, 'update']);
    Route::delete('/project-posts/{id}', [ProjectPostController::class, 'destroy']);

    // Contact admin routes
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
});


