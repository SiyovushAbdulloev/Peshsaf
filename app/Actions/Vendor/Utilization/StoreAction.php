<?php

namespace App\Actions\Vendor\Utilization;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Vendor\Utilization\StoreRequestParams;
use App\Models\Utilization;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Utilization
    {
        $utilization = auth()->user()
            ->outlet
            ->utilizations()
            ->create([
                'type'      => Utilization::CLIENT,
                'number'    => $params->number,
                'date'      => $params->date,
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
