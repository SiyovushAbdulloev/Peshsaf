<?php

namespace App\Actions\Warehouse;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\WarehouseRemain;

class AddWarehouseProductAction extends CoreAction
{
    public function handle(int $warehouseId, Product $product): void
    {
        logger("Добавление товара $product->id в остатки склада $warehouseId");

        $remain = WarehouseRemain::query()->firstOrCreate([
            'warehouse_id'   => $warehouseId,
            'dic_product_id' => $product->dic_product_id,
        ]);

        $remain->products()->create([
            'product_id' => $product->id,
        ]);
    }
}
