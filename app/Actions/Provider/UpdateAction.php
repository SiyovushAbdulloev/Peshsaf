<?php

namespace App\Actions\Provider;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Provider\UpdateRequestParams;
use App\Models\Provider;

class UpdateAction extends CoreAction
{
    public function handle(UpdateRequestParams $params, Provider $provider): Provider
    {
        $files = $provider->files;

        if ($params->files) {
            foreach ($params->files as $file) {
                $files[] = $file->store('providers');
            }
        }

        $provider->update([
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
