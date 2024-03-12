<?php

namespace App\Actions\Substance;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Substance\StoreRequestParams;
use App\Models\Substance;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Substance
    {
        return Substance::create([
            'name' => $params->name
        ]);
    }
}
