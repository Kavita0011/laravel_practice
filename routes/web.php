<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
// can login , register , laravel version, php version
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
    
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', function () {
    return view('app');
});
// Route::get('/{any}', function () {
//     return view('app'); // loads React SPA
// })->where('any', '.*');
require __DIR__.'/auth.php';
