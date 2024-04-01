<?php

namespace App\Actions\Vendor\Return;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Return\ProductStoreRequestParams;
use App\Models\Refund;

class AddProductAction extends CoreAction
{
    public function handle(ProductStoreRequestParams $params, Refund $return): Refund
    {
        $return->products()->create([
            'product_id' => $params->productId,
        ]);

        return $return;
    }
}
