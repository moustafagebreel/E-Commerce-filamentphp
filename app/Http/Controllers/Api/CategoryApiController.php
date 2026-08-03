<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryApiResource;
use App\Models\Category;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get();
        return CategoryApiResource::collection($categories);
    }

    public function show($id)
    {
        $category = Category::where('is_active', true)->findOrFail($id);
        return new CategoryApiResource($category);
    }
}
