<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqApiController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'FaqApiController active']);
    }
}
