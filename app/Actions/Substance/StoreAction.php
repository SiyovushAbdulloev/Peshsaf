<?php

namespace App\Actions\Substance;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Substance\StoreRequestParams;
use App\Models\Dictionaries\ActiveIngredient;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): ActiveIngredient
    {
        return ActiveIngredient::create([
            'name' => $params->name
        ]);
    }
}
