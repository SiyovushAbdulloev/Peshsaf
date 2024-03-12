<?php

namespace App\Actions\Substance;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Substance\StoreRequestParams;
use App\Models\Dictionaries\ActiveIngredient;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, ActiveIngredient $substance): ActiveIngredient
    {
        $substance->update([
            'name' => $params->name
        ]);

        return $substance;
    }
}
