<?php

namespace App\Actions\MeasurementUnit;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\MeasurementUnit\StoreRequestParams;
use App\Models\MeasurementUnit;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): MeasurementUnit
    {
        return MeasurementUnit::create([
            'name' => $params->name
        ]);
    }
}
