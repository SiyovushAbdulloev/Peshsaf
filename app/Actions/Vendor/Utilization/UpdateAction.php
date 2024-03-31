<?php

namespace App\Actions\Vendor\Utilization;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Vendor\Utilization\UpdateRequestParams;
use App\Models\Utilization;

class UpdateAction extends CoreAction
{
    public function handle(UpdateRequestParams $params, Utilization $utilization): Utilization
    {
        $utilization->update([
            'number'    => $params->number,
            'date'      => $params->date,
            'client_id' => $params->clientId,
        ]);

        return $utilization;
    }
}
