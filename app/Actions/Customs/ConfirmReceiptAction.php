<?php

namespace App\Actions\Customs;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\Warehouse;
use App\Models\WarehouseRemain;

class ConfirmReceiptAction extends CoreAction
{
    public function handle(Receipt $receipt)
    {
        foreach ($receipt->products as $receiptProduct) {
            // Создаем/получаем остатки склада по товару
            $remain = WarehouseRemain::query()->firstOrCreate([
                'warehouse_id'   => $receipt->warehouse_id,
                'dic_product_id' => $receiptProduct->dic_product_id,
            ]);

            for ($i = 0; $i < (int)$receiptProduct->count; $i++) {
                // Создаем товар
                $product = Product::query()->create([
                    'dic_product_id' => $receiptProduct->dic_product_id,
                    'model_type'     => Receipt::class,
                    'model_id'       => $receipt->id,
                ]);

                // Добавляем товар в остатки
                $remain->products()->create([
                    'warehouse_id' => $receipt->warehouse_id,
                    'product_id'   => $product->id,
                ]);
            }
        }
    }
}
