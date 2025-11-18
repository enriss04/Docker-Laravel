<?php

use App\Http\Tested\TestedController;
use Illuminate\Support\Facades\Route;

Route::prefix('tested')->group(function () {
    Route::post('/first',   [TestedController::class, 'first']);
});