<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Inertia landing page
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Inertia login page
    Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})
    ->name('login');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');


// Member routes (backend Laravel)
Route::middleware('auth:sanctum')->group(function () {
// Redirect from /dashboard/index to /dashboard

// Actual dashboard view route
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard'); // ✅ Clear and conflict-free

    Route::get('/dashboard/members', [MemberController::class, 'index'])->name('dashboard.memberslist');
    Route::get('/dashboard/createmember', [MemberController::class, 'create'])->name('dashboard.createmember');
    Route::post('/dashboard/addmembers', [MemberController::class, 'store'])->name('dashboard.store');

    Route::get('/dashboard/members/{id}', [MemberController::class, 'show'])->name('dashboard.show');
    Route::put('/dashboard/members/{id}', [MemberController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/members/{id}', [MemberController::class, 'destroy'])->name('dashboard.destroy');
});

// Fortify / Breeze routes
require __DIR__.'/auth.php';
