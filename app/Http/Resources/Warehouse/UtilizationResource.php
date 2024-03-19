<?php

namespace App\Http\Resources\Warehouse;

use App\Http\Resources\ClientResource;
use App\Http\Resources\OutletResource;
use App\Http\Resources\PaginateResourceCollection;
use Illuminate\Http\Request;

/**
 * @property \App\Models\Client $resource
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
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'address' => $this->resource->address,
            'phone' => $this->resource->phone,
            'products_count' => $this->resource->products_count,
            'client' => ClientResource::make($this->whenLoaded('client')),
            'outlet' => OutletResource::make($this->whenLoaded('outlet')),
        ];
    }
}
