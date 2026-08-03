<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewApiController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'ReviewApiController active']);
    }
}
