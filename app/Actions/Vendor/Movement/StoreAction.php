<?php

namespace App\Actions\Vendor\Movement;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Movement\StoreRequestParams;
use App\Models\Movement;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Movement
    {
        $movement = auth()->user()
            ->outlet
            ->movements()
            ->create([
                'number'    => $params->number,
                'date'      => $params->date,
                'outlet_id' => $params->outletId,
            ]);

        foreach ($params->products as $productId) {
            $movement->products()->create([
                'product_id' => $productId,
            ]);
        }

        return $movement;
    }
}
