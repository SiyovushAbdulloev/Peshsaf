<?php

namespace App\Actions\Vendor\Return;

use App\Core\Actions\CoreAction;
use App\Models\RefundProduct;

class RemoveProductAction extends CoreAction
{
    public function handle(RefundProduct $product): bool
    {
        return $product->delete();
    }
}
