<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\ClientResource;
use App\Http\Resources\PaginateResourceCollection;
use App\Http\Resources\Warehouse\Movement\ProductResource;
use Illuminate\Http\Request;

/**
 * @property \App\Models\Utilization $resource
 */
class UtilizationResource extends PaginateResourceCollection
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
            'status'         => $this->resource->status,
            'date'           => $this->resource->date->format('d.m.Y'),
            'number'         => $this->resource->number,
            'products_count' => $this->whenCounted('products'),
            'client'         => ClientResource::make($this->whenLoaded('client')),
            'products'       => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
