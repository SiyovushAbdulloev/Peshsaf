<?php

namespace App\Actions\Outlet;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Outlet\StoreRequestParams;
use App\Models\Outlet;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Outlet
    {
        return Outlet::create([
            'name'    => $params->name,
            'address' => $params->address,
            'phone'   => $params->phone,
        ]);
    }
}
