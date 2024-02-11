<?php

namespace App\Http\Resources;

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
            'provider_full_name' => $this->resource->provider_full_name,
            'country' => new CountryResource($this->whenLoaded('country')),
            'organization_address' => $this->resource->organization_address,
            'phone' => $this->resource->phone,
            'email' => $this->resource->email,
            'organization_info' => $this->resource->organization_info,
            'files' => $this->resource->files
        ];
    }
}
