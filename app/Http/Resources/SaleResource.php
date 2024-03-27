<?php

namespace App\Http\Resources;

use App\Http\Resources\Warehouse\Movement\ProductResource;
use Illuminate\Http\Request;

/**
 * @property \App\Models\Sale $resource
 */
class SaleResource extends PaginateResourceCollection
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
            'client_name' => $this->resource->client_name,
            'client_address' => $this->resource->client_address,
            'client_phone' => $this->resource->client_phone,
            'products_count' => $this->whenCounted('products'),
            'date' => $this->resource->date->format('d.m.Y'),
            'products' => ProductResource::collection($this->whenLoaded('products'))
        ];
    }
}
