<?php

namespace App\Actions\Warehouse\Receipt;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\Warehouse;

class GeneratePdfAction extends CoreAction
{
    public function handle(Receipt $receipt): Receipt
    {
        // Сгенерировать QR для каждого товара
        // и поменять статус товаров в остатках склада на new
        $products = Product::query()
            ->where('status', 'approved')
            ->where('model_type', Receipt::class)
            ->where('model_id', $receipt->id)
            ->get();

        foreach ($products as $product) {
            $newProduct             = $product->replicate();
            $newProduct->model_type = Warehouse::class;
            $newProduct->model_id   = auth()->user()->warehouse_id;
            $newProduct->save();

            $newProduct->status()->transitionTo('new');

            $product->history = true;
            $product->save();
        }

        return $receipt;
    }
}
