<?php

namespace App\Actions\Warehouse;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\WarehouseRemainProduct;

class RemoveWarehouseProductAction extends CoreAction
{
    public function handle(Product $product): bool
    {
        return WarehouseRemainProduct::query()->where('product_id', $product->id)->delete();
    }
}
