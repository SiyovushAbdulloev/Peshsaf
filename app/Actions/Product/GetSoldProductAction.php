<?php

namespace App\Actions\Product;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\StateMachines\StatusProduct;

class GetSoldProductAction extends CoreAction
{
    public function handle(string $barcode): ?Product
    {
        return Product::query()
            ->active()
            ->has('product')
            ->where('status', StatusProduct::SOLD)
            ->where('barcode', $barcode)
            ->first();
    }
}
