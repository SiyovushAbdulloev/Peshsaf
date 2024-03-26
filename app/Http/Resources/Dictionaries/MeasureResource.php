<?php

namespace App\Http\Resources\Dictionaries;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Models\Dictionaries\Measure $resource
 */
class MeasureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'   => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
