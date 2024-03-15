<?php

namespace App\Actions\ActiveIngredient;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\ActiveIngredient\StoreRequestParams;
use App\Models\Dictionaries\ActiveIngredient;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, ActiveIngredient $activeIngredient): ActiveIngredient
    {
        $activeIngredient->update([
            'name' => $params->name
        ]);

        return $activeIngredient;
    }
}
