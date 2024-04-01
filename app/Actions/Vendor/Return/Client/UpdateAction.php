<?php

namespace App\Actions\Vendor\Return\Client;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Return\Client\UpdateRequestParams;
use App\Models\Refund;

class UpdateAction extends CoreAction
{
    public function handle(UpdateRequestParams $params, Refund $return): Refund
    {
        $return->update([
            'number' => $params->number,
            'date'   => $params->date,
        ]);

        return $return;
    }
}
