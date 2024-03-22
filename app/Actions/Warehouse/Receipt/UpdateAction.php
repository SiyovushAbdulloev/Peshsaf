<?php

namespace App\Actions\Warehouse\Receipt;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Warehouse\Receipt\StoreRequestParams;
use App\Models\Receipt;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Receipt $receipt): void
    {
        $receipt->update([
            'number'      => $params->number,
            'date'        => $params->date,
            'supplier_id' => $params->supplierId,
        ]);

        foreach ($params->products as $id => $count) {
            $product        = $receipt->products->find($id);
            $product->count = $count;
            $product->save();
        }
    }
}
