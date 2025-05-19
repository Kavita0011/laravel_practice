<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are stateless and meant for APIs (no session, no CSRF).
*/
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication routes
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout'])->name('logout');

// dashboard
Route::middleware('auth:sanctum')->group(function () {
    // Dashboard data (optional, could be a JSON response)
    Route::get('/dashboard', function (Request $request) {
        return response()->json(['message' => 'Dashboard data here']);
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // Posts CRUD routes
    // Route::resource('/posts', [PostController::class]);
    // Route::apiResource('/posts', [PostController::class, 'store']);
    // add more routes here
});