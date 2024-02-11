<?php

namespace App\Actions\MeasurementUnit;

use App\Core\Actions\CoreAction;
use App\Http\Resources\MeasurementUnitResource;
use App\Models\MeasurementUnit;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexAction extends CoreAction
{
    public function handle(): AnonymousResourceCollection
    {
        return MeasurementUnitResource::collection(MeasurementUnit::get());
    }
}
