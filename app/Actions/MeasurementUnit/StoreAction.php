<?php

namespace App\Actions\MeasurementUnit;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\MeasurementUnit\StoreRequestParams;
use App\Models\Dictionaries\Measure;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Measure
    {
        return Measure::create([
            'name' => $params->name
        ]);
    }
}
