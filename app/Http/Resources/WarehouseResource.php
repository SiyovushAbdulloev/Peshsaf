<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

/**
 * @property \App\Models\Warehouse $resource
 */
class WarehouseResource extends PaginateResourceCollection
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
        ];
    }
}
