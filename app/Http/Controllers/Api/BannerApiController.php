<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerApiController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'BannerApiController active']);
    }
}
