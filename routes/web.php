<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationStatusController;
use App\Http\Controllers\NotificationTypeController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
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
    
    // Project Routes
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');  
    
    // Notification Routes
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::get('notifications/{notification}/edit', [NotificationController::class, 'edit'])->name('notifications.edit');
    Route::put('notifications/{notification}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // Notification Types Routes
    Route::get('notification-types', [NotificationTypeController::class, 'index'])->name('notification-types.index');
    Route::get('notification-types/create', [NotificationTypeController::class, 'create'])->name('notification-types.create');
    Route::post('notification-types', [NotificationTypeController::class, 'store'])->name('notification-types.store');
    Route::get('notification-types/{notificationType}/edit', [NotificationTypeController::class, 'edit'])->name('notification-types.edit');
    Route::put('notification-types/{notificationType}', [NotificationTypeController::class, 'update'])->name('notification-types.update');
    Route::delete('notification-types/{notificationType}', [NotificationTypeController::class, 'destroy'])->name('notification-types.destroy');

    // Notification Statuses Routes
    Route::get('notification-statuses', [NotificationStatusController::class, 'index'])->name('notification-statuses.index');
    Route::get('notification-statuses/create', [NotificationStatusController::class, 'create'])->name('notification-statuses.create');
    Route::post('notification-statuses', [NotificationStatusController::class, 'store'])->name('notification-statuses.store');
    Route::get('notification-statuses/{notificationStatus}/edit', [NotificationStatusController::class, 'edit'])->name('notification-statuses.edit');
    Route::put('notification-statuses/{notificationStatus}', [NotificationStatusController::class, 'update'])->name('notification-statuses.update');
    Route::delete('notification-statuses/{notificationStatus}', [NotificationStatusController::class, 'destroy'])->name('notification-statuses.destroy');

});

require __DIR__ . '/auth.php';
