<?php

namespace App\Actions\Warehouse\Movement;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Movement\ProductStoreRequestParams;
use App\Models\Movement;

class AddProductAction extends CoreAction
{
    public function handle(ProductStoreRequestParams $params, Movement $movement): Movement
    {
        $movement->products()->create([
            'product_id' => $params->productId,
        ]);

        return $movement;
    }
}
