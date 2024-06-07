<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/transactions', [AdminController::class, 'reports'])->name('reports');
    Route::get('/download-report', [AdminController::class, 'exportWeeklyReport'])->name('dowload-reports');

    Route::post('/admin/credit', [AdminController::class, 'credit']);
    Route::post('/admin/debit', [AdminController::class, 'debit']);
});

require __DIR__ . '/auth.php';
