<?php

namespace App\Http\Resources;

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
        $product = $this->whenLoaded('product');
        return [
            'id' => $this->resource->id,
            'qrcode' => $this->resource->barcode,
            'barcode' => $product?->barcode,
            'name' => $product?->name,
        ];
    }
}
