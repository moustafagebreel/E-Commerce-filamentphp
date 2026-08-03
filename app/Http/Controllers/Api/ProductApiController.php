<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductApiResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true)->with(['category', 'brand']);

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->latest()->paginate($request->get('per_page', 15));

        return ProductApiResource::collection($products);
    }

    public function show($id)
    {
        $product = Product::where('is_active', true)
            ->with(['category', 'brand', 'reviews'])
            ->findOrFail($id);

        return new ProductApiResource($product);
    }
}
