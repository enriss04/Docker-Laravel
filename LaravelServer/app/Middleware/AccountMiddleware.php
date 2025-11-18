<?php

namespace App\Middleware;

use Closure;
use App\Http\Auth\useCases\activeAccess;

class AccountMiddleware
{
    public function handle($request, Closure $next){
        activeAccess::validate('cuenta_id', $request->user()->cuenta_id);
        
        return $next($request);
    }
}