<?php

namespace App\Actions\Warehouse\Utilization;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Utilization\StoreRequestParams;
use App\Models\Utilization;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Utilization
    {
        $utilization = auth()->user()
            ->warehouse
            ->utilizations()
            ->create([
                'type'      => $params->type,
                'number'    => $params->number,
                'date'      => $params->date,
                'outlet_id' => $params->outletId,
                'client_id' => $params->clientId,
            ]);

        foreach ($params->products as $productId) {
            $utilization->products()->create([
                'product_id' => $productId,
            ]);
        }

        return $utilization;
    }
}
