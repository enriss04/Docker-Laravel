<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('tested')->group(base_path('app/Http/Tested/TestedRoutes.php'));

Route::middleware(['request-validation'])->group(function () {
    require base_path('app/Http/Auth/AuthRoutes.php');
});

Route::get('/cache', function () {
    if (request('key') !== '1234') {
        abort(403, 'No autorizado');
    }

    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');

    return response()->json(['status' => 'ok']);
});