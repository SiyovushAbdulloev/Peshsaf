<?php

namespace App\Actions\Vendor\Receipt;

use App\Actions\Warehouse\RemoveWarehouseProductAction;
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

            // Удаление товара из остатов склада
            app(RemoveWarehouseProductAction::class)->execute($product);

            // Оприходование товара в остатки торговой точки
            $outlet = auth()->user()->outlet;
            logger("Добавление товара $product->id в остатки торговой точки $outlet->id");

            $outlet->products()->create([
                'product_id'   => $newProduct->id,
                'warehouse_id' => $receipt->warehouse_id,
            ]);

            $product->history = true;
            $product->save();
        }

        return $receipt;
    }
}
