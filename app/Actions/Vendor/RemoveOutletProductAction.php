<?php

namespace App\Actions\Vendor;

use App\Core\Actions\CoreAction;
use App\Models\OutletProduct;
use App\Models\Product;

class RemoveOutletProductAction extends CoreAction
{
    public function handle(Product $product): bool
    {
        return OutletProduct::where('product_id', $product->id)->delete();
    }
}
