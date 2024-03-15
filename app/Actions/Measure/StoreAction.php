<?php

namespace App\Actions\Measure;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Measure\StoreRequestParams;
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
