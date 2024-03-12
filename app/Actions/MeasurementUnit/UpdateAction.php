<?php

namespace App\Actions\MeasurementUnit;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\MeasurementUnit\StoreRequestParams;
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
