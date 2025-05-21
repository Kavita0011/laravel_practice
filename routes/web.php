<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
// Landing page (can be removed if not using Inertia)
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// // Auth routes (blade-based)
// Route::post('/api/login', [LoginController::class, 'login'])->name('login');
// Route::post('/api/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
// Route::post('/api/register', [RegisterController::class, 'register'])->name('register');

// // Dashboard (only after login)
// Route::get('/api/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth')->name('dashboard');

// Route::get('/login', function () {
//     return Inertia::render('Auth/Login');
// })->name('login');


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');
// Member routes (blade-based UI)
Route::get('/admin/members', [MemberController::class, 'index'])->name('dashboard.memberslist');
    
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/createmember', [MemberController::class, 'create'])->name('dashboard.createmember');
    Route::post('/admin/addmembers', [MemberController::class, 'store'])->name('dashboard.store');

    Route::get('/admin/members/{id}', [MemberController::class, 'show'])->name('dashboard.show');
    Route::put('/admin/members/{id}', [MemberController::class, 'update'])->name('dashboard.update');
    Route::delete('/admin/members/{id}', [MemberController::class, 'destroy'])->name('dashboard.destroy');
});

// Optional: for Inertia-based dashboard (can be removed if not using)
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth:sanctum', 'verified'])->name('dashboard.inertia');

// Fallback React/SPA app loader (optional)
// Route::get('/memberlist', function () {
//     return view('app');
// });

// Laravel Breeze/Fortify/etc.
require __DIR__.'/auth.php';
