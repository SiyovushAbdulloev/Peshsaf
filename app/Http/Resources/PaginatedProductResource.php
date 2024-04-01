<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/**
 * @property \App\Models\Product $resource
 */
class PaginatedProductResource extends PaginateResourceCollection
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
            'barcode' => $this->resource->barcode,
            'name'    => $this->resource->product->name,
        ];
    }
}
