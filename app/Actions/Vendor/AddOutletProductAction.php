<?php

namespace App\Actions\Vendor;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\Warehouse;

class AddOutletProductAction extends CoreAction
{
    public function handle(Product $product): void
    {
        $outlet = auth()->user()->outlet;
        logger("Добавление товара $product->id в остатки торговой точки $outlet->id");

        $warehouseId = Product::query()
            ->where('model_type', Warehouse::class)
            ->where('barcode', $product->barcode)
            ->first()
            ->model_id;

        $outlet->products()->create([
            'product_id'   => $product->id,
            'warehouse_id' => $warehouseId,
        ]);
    }
}
