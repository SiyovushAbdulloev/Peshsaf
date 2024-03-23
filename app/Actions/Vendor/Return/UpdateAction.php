<?php

namespace App\Actions\Vendor\Return;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Return\StoreRequestParams;
use App\Models\Refund;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Refund $return): Refund
    {
        $return->update([
            'date' => $params->date,
        ]);

        foreach ($params->products as $productId) {
            $return->products()->create([
                'product_id' => $productId
            ]);
        }

//            $product = Product::find($productId);
//
//            $newProduct             = $product->duplicate();
//            $newProduct->model_type = Outlet::class;
//            $newProduct->model_id   = auth()->user()->outlet->id;
//            $newProduct->save();
//
//            $product->history = true;
//            $product->save();
        return $return;
    }
}
