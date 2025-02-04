<?php

use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Status Routes
    Route::get('statuses', [StatusController::class, 'index'])->name('statuses.index');
    Route::get('statuses/create', [StatusController::class, 'create'])->name('statuses.create');
    Route::post('statuses', [StatusController::class, 'store'])->name('statuses.store');
    Route::get('statuses/{status}/edit', [StatusController::class, 'edit'])->name('statuses.edit');
    Route::put('statuses/{status}', [StatusController::class, 'update'])->name('statuses.update');
    Route::delete('statuses/{status}', [StatusController::class, 'destroy'])->name('statuses.destroy');

    // Priority Routes
    Route::get('priorities', [PriorityController::class, 'index'])->name('priorities.index');
    Route::get('priorities/create', [PriorityController::class, 'create'])->name('priorities.create');
    Route::post('priorities', [PriorityController::class, 'store'])->name('priorities.store');
    Route::get('priorities/{priority}/edit', [PriorityController::class, 'edit'])->name('priorities.edit');
    Route::put('priorities/{priority}', [PriorityController::class, 'update'])->name('priorities.update');
    Route::delete('priorities/{priority}', [PriorityController::class, 'destroy'])->name('priorities.destroy');
    
    
});

require __DIR__ . '/auth.php';
