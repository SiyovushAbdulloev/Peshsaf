<?php

namespace App\Actions\Warehouse\Movement;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Movement\UpdateRequestParams;
use App\Models\Movement;

class UpdateAction extends CoreAction
{
    public function handle(UpdateRequestParams $params, Movement $movement): Movement
    {
        $movement->update([
            'number'    => $params->number,
            'date'      => $params->date,
            'outlet_id' => $params->outletId,
        ]);

        return $movement;
    }
}
