<?php

namespace App\Http\Resources\IndexPage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
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
            'organization_name' => $this->resource->organization_name,
            'organization_address' => $this->resource->organization_address,
            'phone' => $this->resource->phone,
            'email' => $this->resource->email,
        ];
    }
}
