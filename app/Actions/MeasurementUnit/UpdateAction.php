<?php

namespace App\Actions\MeasurementUnit;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\MeasurementUnit\StoreRequestParams;
use App\Models\MeasurementUnit;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, MeasurementUnit $measurementUnit): MeasurementUnit
    {
        $measurementUnit->update([
            'name' => $params->name
        ]);

        return $measurementUnit;
    }
}
