<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/**
 * @property \App\Models\Client $resource
 */
class MovementResource extends PaginateResourceCollection
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
            'date' => $this->resource->date->format('d.m.Y'),
            'products_count' => $this->resource->products_count,
            'outlet' => OutletResource::make($this->whenLoaded('outlet')),
        ];
    }
}
