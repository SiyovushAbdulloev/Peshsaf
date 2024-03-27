<?php

namespace App\Actions\Vendor\Return\Client;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Return\Client\StoreRequestParams;
use App\Models\Refund;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): void
    {
        $return = auth()->user()
            ->outlet
            ->returns()
            ->create([
                'type'      => Refund::CLIENT,
                'client_id' => $params->clientId,
                'date'      => $params->date,
                'number'    => $params->number,
            ]);

        foreach ($params->products as $productId) {
            $return->products()->create([
                'product_id' => $productId,
            ]);
        }
    }
}
