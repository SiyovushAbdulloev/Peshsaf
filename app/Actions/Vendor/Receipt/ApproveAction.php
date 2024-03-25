<?php

namespace App\Actions\Vendor\Receipt;

use App\Core\Actions\CoreAction;
use App\Models\Movement;
use App\Models\Outlet;
use App\Models\Product;

class ApproveAction extends CoreAction
{
    public function handle(Movement $receipt): Movement
    {
        foreach ($receipt->products as $receipProduct) {
            $product = Product::find($receipProduct->product_id);

            $newProduct             = $product->replicate();
            $newProduct->model_type = Outlet::class;
            $newProduct->model_id   = auth()->user()->outlet_id;
            $newProduct->save();

            auth()->user()
                ->outlet
                ->products()
                ->create([
                    'product_id'   => $newProduct->id,
                    'warehouse_id' => $receipt->warehouse_id,
                ]);

            $product->history = true;
            $product->save();
        }

        return $receipt;
    }
}
