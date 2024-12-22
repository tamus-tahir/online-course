<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseVideoController;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::get('/dashboard/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update', [DashboardController::class, 'update'])->name('dashboard.update');

    Route::middleware('role:superadmin')->group(function () {
        Route::resource('/setting', SettingController::class);
        Route::resource('/user', UserController::class);
        Route::resource('/category', CategoryController::class);
    });

    Route::middleware('role:superadmin,lecture')->group(function () {
        Route::resource('/course', CourseController::class);

        Route::get('/coursevideo/{course}/show', [CourseVideoController::class, 'show'])->name('coursevideo.show');
        Route::get('/coursevideo/{course}/create', [CourseVideoController::class, 'create'])->name('coursevideo.create');
        Route::post('/coursevideo', [CourseVideoController::class, 'store'])->name('coursevideo.store');
        Route::get('/coursevideo/{courseVideo}/edit', [CourseVideoController::class, 'edit'])->name('coursevideo.edit');
        Route::put('/coursevideo/{courseVideo}/update', [CourseVideoController::class, 'update'])->name('coursevideo.update');
        Route::delete('/coursevideo/{courseVideo}/destroy', [CourseVideoController::class, 'destroy'])->name('coursevideo.destroy');
        Route::post('/coursevideo/import', [CourseVideoController::class, 'import'])->name('coursevideo.import');
    });
});

require __DIR__ . '/auth.php';
