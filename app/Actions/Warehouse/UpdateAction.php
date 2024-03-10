<?php

namespace App\Actions\Warehouse;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Warehouse\StoreRequestParams;
use App\Models\Warehouse;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Warehouse $warehouse): Warehouse
    {
        $warehouse->update([
            'name' => $params->name,
            'address' => $params->address,
            'phone' => $params->phone,
        ]);

        return $warehouse;
    }
}
