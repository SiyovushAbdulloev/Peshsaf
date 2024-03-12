<?php

namespace App\Actions\Warehouse;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Warehouse\StoreRequestParams;
use App\Models\Warehouse;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Warehouse
    {
        return Warehouse::create([
            'name' => $params->name,
            'address' => $params->address,
            'phone' => $params->phone,
        ]);
    }
}
