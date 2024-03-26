<?php

namespace App\Http\Resources;

use App\Http\Resources\Warehouse\Movement\ProductResource;
use Illuminate\Http\Request;

/**
 * @property \App\Models\Refund $resource
 */
class ReturnResource extends PaginateResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->resource->id,
            'type'           => $this->resource->type,
            'status'         => $this->resource->status,
            'date'           => $this->resource->date->format('d.m.Y'),
            'number'         => $this->resource->number,
            'products_count' => $this->resource->products_count,
            'outlet'         => OutletResource::make($this->whenLoaded('origin')),
            'products'       => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
