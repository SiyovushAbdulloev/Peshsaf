<?php

namespace App\Actions\ActiveIngredient;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\ActiveIngredient\StoreRequestParams;
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
