<?php

namespace App\Http\Resources\Vendor;

use App\Http\Resources\PaginateResourceCollection;
use Illuminate\Http\Request;

/**
 * @property \App\Models\Client $resource
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
            'id' => $this->resource->id,
            'qrcode' => $this->resource->product?->barcode,
            'barcode' => $this->resource->product?->product?->barcode,
            'name' => $this->resource->product?->product?->name,
            'measure_name' => $this->resource->product?->product?->measure?->name,
        ];
    }
}
