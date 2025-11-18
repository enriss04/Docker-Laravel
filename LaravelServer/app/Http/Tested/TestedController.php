<?php

namespace App\Http\Tested;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestedController extends Controller{

    public function first(Request $request)
    {
        dddd
        return response()->json(["msg" => "Testeado", "status" => true]);
    }
  
}