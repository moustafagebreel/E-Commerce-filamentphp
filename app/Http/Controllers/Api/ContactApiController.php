<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactApiController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'ContactApiController active']);
    }
}
