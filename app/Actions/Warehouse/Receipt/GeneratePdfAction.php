<?php

namespace App\Actions\Warehouse\Receipt;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\Warehouse;
use App\Models\WarehouseRemain;

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
            // Создаем/получаем остатки склада по товару
            $remain = WarehouseRemain::query()->firstOrCreate([
                'warehouse_id'   => $receipt->warehouse_id,
                'dic_product_id' => $product->dic_product_id,
            ]);

            $newProduct             = $product->replicate();
            $newProduct->model_type = Warehouse::class;
            $newProduct->model_id   = auth()->user()->warehouse_id;
            $newProduct->save();

            $newProduct->status()->transitionTo('new');

            // Добавляем товар в остатки
            $remain->products()->create([
                'warehouse_id' => $remain->warehouse_id,
                'product_id'   => $newProduct->id,
            ]);

            $product->history = true;
            $product->save();
        }

        return $receipt;
    }
}
