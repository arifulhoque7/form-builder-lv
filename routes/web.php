<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Auth routes
Route::middleware(['auth'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Form Management Routes
    Route::prefix('forms')->group(function () {
        Route::get('/', [FormController::class, 'index'])->name('forms.index');
        Route::get('/create', [FormController::class, 'create'])->name('forms.create');
        Route::post('/', [FormController::class, 'store'])->name('forms.store');
        Route::get('/{form}', [FormController::class, 'show'])->name('forms.show');
        Route::get('/{form}/edit', [FormController::class, 'edit'])->name('forms.edit');
        Route::put('/{form}', [FormController::class, 'update'])->name('forms.update');
        Route::delete('/{form}', [FormController::class, 'destroy'])->name('forms.destroy');
        Route::post('/{form}/update-field-order', [FormController::class, 'updateFieldOrder'])->name('forms.update-field-order');
    });
});

// Include auth routes
require __DIR__.'/auth.php';
