<?php

namespace App\Http\Resources\Warehouse\Movement;

use App\Http\Resources\Dictionaries\MeasureResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\MovementProduct $resource
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
            'product_id' => $this->resource->product_id,
            'name'       => $this->resource->dicProduct->name,
            'qrcode'     => $this->resource->product->barcode,
            'barcode'    => $this->resource->dicProduct->barcode,
            'measure'    => MeasureResource::make($this->dicProduct->measure),
        ];
    }
}
