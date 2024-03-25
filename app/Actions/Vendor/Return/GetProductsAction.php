<?php

namespace App\Actions\Vendor\Return;

use App\Core\Actions\CoreAction;
use App\Models\OutletProduct;
use Illuminate\Database\Eloquent\Collection;

class GetProductsAction extends CoreAction
{
    public function handle(array $ids = []): ?Collection
    {
        return OutletProduct::with('warehouse')
            ->whereIn('product_id', old('products', $ids))
            ->get();
    }
}
