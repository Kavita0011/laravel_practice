<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are stateless and use Sanctum for API authentication.
*/

// Public Auth Routes
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Protected Routes (require Sanctum auth)
Route::middleware('auth:sanctum')->group(function () {

    // Authenticated User Info
    Route::get('/usermembers', function (Request $request) {
        return response()->json($request->user());
    });

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        return response()->json(['message' => 'Dashboard data here']);
    });

    // Member CRUD
    // Route::apiResource('members', MemberController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // Posts CRUD
    Route::apiResource('posts', PostController::class);
});
