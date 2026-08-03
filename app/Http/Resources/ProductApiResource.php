<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => (float) $this->price,
            'images' => array_map(fn($img) => url('storage/' . $img), $this->images ?? []),
            'is_active' => (bool) $this->is_active,
            'is_featured' => (bool) $this->is_featured,
            'in_stock' => (bool) $this->in_stock,
            'on_sale' => (bool) $this->on_sale,
            'category' => new CategoryApiResource($this->whenLoaded('category')),
            'brand' => new BrandApiResource($this->whenLoaded('brand')),
            'average_rating' => $this->average_rating,
            'reviews_count' => $this->reviews_count,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
