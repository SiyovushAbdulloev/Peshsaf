<?php

namespace App\Actions\Provider;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Provider\StoreRequestParams;
use App\Models\Provider;
use Storage;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Provider
    {
        $provider = Provider::create([
            'organization_name' => $params->organizationName,
            'full_name' => $params->providerFullName,
            'country_id' => $params->countryId,
            'organization_address' => $params->organizationAddress,
            'phone' => $params->phone,
            'email' => $params->email,
            'organization_info' => $params->organizationInfo,
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
