<?php

namespace App\Actions\Supplier;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Supplier\StoreRequestParams;
use App\Models\Supplier;
use Storage;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Supplier
    {
        $provider = Supplier::create([
            'organization_name' => $params->organizationName,
            'full_name' => $params->fullName,
            'country_id' => $params->countryId,
            'organization_address' => $params->organizationAddress,
            'phone' => $params->phone,
            'email' => $params->email,
            'description' => $params->description,
        ]);

        foreach ($params->files as $file) {
            $provider->files()->create([
                'filename' => Storage::put('', $file),
                'original_filename' => $file->getClientOriginalName(),
                'mimetype' => $file->getClientMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        return $provider;
    }
}
