<?php

use App\Http\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('login')->group(function () {
    Route::post('/first',   [AuthController::class, 'first']);
});