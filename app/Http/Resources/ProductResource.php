<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/**
 * @property \App\Models\WarehouseRemainProduct $resource
 */
class ProductResource extends PaginateResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->resource->id,
            'qrcode'  => $this->resource->product->barcode,
            'barcode' => $this->resource->dicProduct?->barcode,
            'name'    => $this->resource->dicProduct?->name,
        ];
    }
}
