<?php

namespace App\Actions\Warehouse\Utilization;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Utilization\ProductStoreRequestParams;
use App\Models\Utilization;

class AddProductAction extends CoreAction
{
    public function handle(ProductStoreRequestParams $params, Utilization $utilization): Utilization
    {
        $utilization->products()->create([
            'product_id' => $params->productId,
        ]);

        return $utilization;
    }
}
