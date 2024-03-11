<?php

namespace App\Actions\Supplier;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Supplier\UpdateRequestParams;
use App\Models\Supplier;

class UpdateAction extends CoreAction
{
    public function handle(UpdateRequestParams $params, Supplier $provider): Supplier
    {
        $files = $provider->files;

        if ($params->files) {
            foreach ($params->files as $file) {
                $files[] = $file->store('suppliers');
            }
        }

        $provider->update([
            'organization_name' => $params->organizationName,
            'provider_full_name' => $params->fullName,
            'country_id' => $params->countryId,
            'organization_address' => $params->organizationAddress,
            'phone' => $params->phone,
            'email' => $params->email,
            'description' => $params->description,
            'files' => $files
        ]);

        return $provider;
    }
}
