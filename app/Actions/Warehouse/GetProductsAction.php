<?php

namespace App\Actions\Warehouse;

use App\Core\Actions\CoreAction;
use App\Models\WarehouseRemainProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GetProductsAction extends CoreAction
{
    public function handle(array $ids = []): ?Collection
    {
        return WarehouseRemainProduct::with('product', 'dicProduct.measure')
            ->whereHas('product', fn(Builder $query) => $query->active())
            ->whereIn('product_id', old('products', $ids))
            ->get();
    }
}
