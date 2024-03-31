<?php

namespace App\Http\Resources\Warehouse;

use App\Http\Resources\Dictionaries\MeasureResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\Product $resource
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->resource->id,
            'name'       => $this->resource->product->name,
            'qrcode'     => $this->resource->barcode,
            'barcode'    => $this->resource->product->barcode,
            'sender'     => $this->resource->sender,
            'measure'    => MeasureResource::make($this->product->measure),
        ];
    }
}
