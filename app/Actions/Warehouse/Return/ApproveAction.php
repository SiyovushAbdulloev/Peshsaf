<?php

namespace App\Actions\Warehouse\Return;

use App\Actions\Vendor\RemoveOutletProductAction;
use App\Actions\Warehouse\AddWarehouseProductAction;
use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\Refund;
use App\StateMachines\StatusReturn;

class ApproveAction extends CoreAction
{
    public function handle(Refund $return): Refund
    {
        foreach ($return->products as $returnProduct) {
            $product                = Product::find($returnProduct->product_id);

            $newProduct             = $product->replicate();
            $newProduct->model_type = Refund::class;
            $newProduct->model_id   = $return->id;
            $newProduct->save();

            // Удаляем продукт из остатков торговой точки
            app(RemoveOutletProductAction::class)->execute($returnProduct->product);

            // Приходуем в остатки склада
            app(AddWarehouseProductAction::class)->execute($return->warehouse_id, $newProduct);

            $product->history = true;
            $product->save();
        }

        $return->status()->transitionTo(StatusReturn::FINISHED);

        return $return;
    }
}
