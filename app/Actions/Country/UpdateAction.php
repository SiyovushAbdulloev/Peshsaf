<?php

namespace App\Actions\Country;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Country\StoreRequestParams;
use App\Models\Country;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Country $country): Country
    {
        $country->update([
            'name' => $params->name
        ]);

        return $country;
    }
}
