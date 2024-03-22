<?php

namespace App\Actions\Warehouse;

use App\Core\Actions\CoreAction;
use App\Models\WarehouseRemainProduct;
use Illuminate\Database\Eloquent\Builder;

class GetProductAction extends CoreAction
{
    public function handle(string $barcode): ?WarehouseRemainProduct
    {
        return WarehouseRemainProduct::whereHas('product', function (Builder $query) use ($barcode) {
            $query->active()->where('barcode', $barcode);
        })->first();
    }
}
