<?php

namespace App\Actions\Vendor\Receipt;

use App\Core\Actions\CoreAction;
use App\Models\Receipt;
use Illuminate\Http\Request;

class StoreAction extends CoreAction
{
    public function handle(Request $request): Receipt
    {
        $receipt = auth()->user()
            ->outlet
            ->receipts()
            ->create($request->validated());

        foreach ($request->get('products') as $productId) {
            $receipt->products()->create([
                'dic_product_id' => $productId
            ]);
        }

            $product = Product::find($productId);

            $newProduct             = $product->duplicate();
            $newProduct->model_type = Outlet::class;
            $newProduct->model_id   = auth()->user()->outlet->id;
            $newProduct->save();

            $product->history = true;
            $product->save();

    }
}
