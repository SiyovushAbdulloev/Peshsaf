<?php

namespace App\Actions\Vendor\Return;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class GetProductsAction extends CoreAction
{
    public function handle(array $ids = []): ?Collection
    {
        return Product::whereIn('id', old('products', $ids))->get();
    }
}
