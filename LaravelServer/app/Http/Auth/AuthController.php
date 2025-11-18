<?php

namespace App\Http\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller{

    public function first(Request $request)
    {
        return response()->json(["msg" => "Cuenta listada", "status" => true]);
    }
  
}