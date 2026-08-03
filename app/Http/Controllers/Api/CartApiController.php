<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartApiController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'CartApiController active']);
    }
}
