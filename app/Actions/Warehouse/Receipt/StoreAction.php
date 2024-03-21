<?php

namespace App\Actions\Warehouse\Receipt;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Warehouse\Receipt\StoreRequestParams;
use App\Models\Receipt;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Receipt
    {
        $receipt = auth()->user()
            ->warehouse
            ->receipts()
            ->create([
                'number'      => $params->number,
                'date'        => $params->date,
                'supplier_id' => $params->supplierId,
            ]);

        foreach ($params->products as $productId) {
            $receipt->products()->create([
                'dic_product_id' => $productId,
            ]);
        }

        return $receipt;
    }
}
