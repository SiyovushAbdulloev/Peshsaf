<?php

namespace App\Http\Resources\Warehouse;

use App\Http\Resources\ClientResource;
use App\Http\Resources\OutletResource;
use App\Http\Resources\PaginateResourceCollection;
use App\Http\Resources\SimpleProductResource;
use Illuminate\Http\Request;

/**
 * @property \App\Models\Utilization $resource
 */
class UtilizationResource extends PaginateResourceCollection
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
            'type'           => $this->resource->type,
            'status'         => $this->resource->status,
            'date'           => $this->resource->date->format('d.m.Y'),
            'number'         => $this->resource->number,
            'products_count' => $this->resource->products_count,
            'client'         => ClientResource::make($this->whenLoaded('client')),
            'outlet'         => OutletResource::make($this->whenLoaded('outlet')),
            'products'       => SimpleProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
