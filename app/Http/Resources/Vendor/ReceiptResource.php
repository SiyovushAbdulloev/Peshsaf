<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\PaginateResourceCollection;
use App\Http\Resources\Warehouse\Movement\ProductResource;
use App\Http\Resources\WarehouseResource;
use Illuminate\Http\Request;

/**
 * @property \App\Models\Movement $resource
 */
class ReceiptResource extends PaginateResourceCollection
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
            'number'         => $this->resource->number,
            'date'           => $this->resource->date->format('d.m.Y'),
            'products_count' => $this->whenCounted('products'),
            'warehouse'      => WarehouseResource::make($this->whenLoaded('warehouse')),
            'products'       => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
