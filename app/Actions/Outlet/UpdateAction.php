<?php

namespace App\Actions\Outlet;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Outlet\StoreRequestParams;
use App\Models\Outlet;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Outlet $outlet): Outlet
    {
        $outlet->update([
            'name'    => $params->name,
            'address' => $params->address,
            'phone'   => $params->phone,
        ]);

        return $outlet;
    }
}
