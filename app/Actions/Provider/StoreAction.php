<?php

namespace App\Actions\Provider;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Provider\StoreRequestParams;
use App\Models\Provider;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Provider
    {
        $files = [];
        foreach ($params->files as $file) {
            $files[] = $file->store('providers');
        }

        $provider = Provider::create([
            'organization_name' => $params->organizationName,
            'provider_full_name' => $params->providerFullName,
            'country_id' => $params->countryId,
            'organization_address' => $params->organizationAddress,
            'phone' => $params->phone,
            'email' => $params->email,
            'organization_info' => $params->organizationInfo,
            'files' => $files
        ]);

        return $provider;
    }
}
