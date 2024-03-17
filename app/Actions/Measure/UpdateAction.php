<?php

namespace App\Actions\Measure;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Measure\StoreRequestParams;
use App\Models\Dictionaries\Measure;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Measure $measurementUnit): Measure
    {
        $measurementUnit->update([
            'name' => $params->name
        ]);

        return $measurementUnit;
    }
}
