<?php

namespace App\Http\Resources;

use App\Http\Resources\Warehouse\Movement\ProductResource;
use Illuminate\Http\Request;

/**
 * @property \App\Models\Movement $resource
 */
class MovementResource extends PaginateResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'number' => $this->resource->number,
            'date' => $this->resource->date->format('d.m.Y'),
            'products_count' => $this->resource->products_count,
            'outlet' => OutletResource::make($this->whenLoaded('outlet')),
            'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
