<?php

namespace App\Actions\Warehouse\Movement;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Movement\StoreRequestParams;
use App\Models\Movement;
use App\Models\Outlet;
use App\Models\Product;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Movement
    {
        $movement = auth()->user()
            ->warehouse
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

//            TODO перенести код в экш конфирма
//            $product = Product::find($productId);
//
//            $newProduct             = $product->duplicate();
//            $newProduct->model_type = Outlet::class;
//            $newProduct->model_id   = $params->outletId;
//            $newProduct->save();
//
//            $product->history = true;
//            $product->save();
        }

        return $movement;
    }
}
