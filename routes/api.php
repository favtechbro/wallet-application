<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::post('/users', [UserController::class, 'register']);
Route::post('/users/tokens', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/wallet/credit', [WalletController::class, 'credit']);
    Route::post('/wallet/debit', [WalletController::class, 'debit']);
    Route::get('/wallet/balance', [WalletController::class, 'balance']);
});
