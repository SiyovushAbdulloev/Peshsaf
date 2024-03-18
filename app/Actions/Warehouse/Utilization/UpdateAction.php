<?php

namespace App\Actions\Warehouse\Utilization;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Utilization\UpdateRequestParams;
use App\Models\Utilization;

class UpdateAction extends CoreAction
{
    public function handle(UpdateRequestParams $params, Utilization $utilization): Utilization
    {
        $utilization->update([
            'number'    => $params->number,
            'date'      => $params->date,
            'outlet_id' => $params->outletId,
        ]);

        return $utilization;
    }
}
