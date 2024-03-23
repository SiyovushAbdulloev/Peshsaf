<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\Client $resource
 */
class SimpleProductResource extends JsonResource
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
            'qrcode' => $this->resource->barcode,
            'barcode' => $this->resource->dicProduct?->barcode,
            'name' => $this->resource->dicProduct?->name,
            'model' => $this->resource->model?->name,
        ];
    }
}
