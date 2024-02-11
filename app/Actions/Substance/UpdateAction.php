<?php

namespace App\Actions\Substance;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Substance\StoreRequestParams;
use App\Models\Substance;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Substance $substance): Substance
    {
        $substance->update([
            'name' => $params->name
        ]);

        return $substance;
    }
}
