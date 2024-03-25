<?php

namespace App\Actions\Vendor\Receipt;

use App\Core\Actions\CoreAction;
use App\Models\Movement;
use Illuminate\Http\Request;

class StoreAction extends CoreAction
{
    public function handle(Request $request): Movement
    {
        $receipt = auth()->user()
            ->outlet
            ->movements()
            ->create($request->validated());

        foreach ($request->get('products') as $productId) {
            $receipt->products()->create([
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
        return $receipt;
    }
}
