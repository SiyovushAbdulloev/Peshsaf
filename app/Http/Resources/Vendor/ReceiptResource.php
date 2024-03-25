<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\PaginateResourceCollection;
use App\Http\Resources\WarehouseResource;
use Illuminate\Http\Request;

/**
 * @property \App\Models\Client $resource
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
            'id' => $this->resource->id,
            'number' => $this->resource->number,
            'date' => $this->resource->date->format('d.m.Y'),
            'products_count' => $this->resource->products_count,
            'warehouse' => WarehouseResource::make($this->whenLoaded('warehouse')),
            'products' => ProductResource::collection($this->whenLoaded('products.product.product.measure')),
        ];
    }
}
