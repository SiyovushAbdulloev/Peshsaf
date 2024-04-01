<?php

namespace App\Actions\Warehouse;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\WarehouseRemainProduct;
use App\StateMachines\StatusProduct;
use Illuminate\Database\Eloquent\Builder;

class GetNewProductAction extends CoreAction
{
    public function handle(string $barcode): ?Product
    {
        return WarehouseRemainProduct::query()
            ->whereHas('product', function (Builder $query) use ($barcode) {
                $query
                    ->active()
                    ->where('status', StatusProduct::NEW)
                    ->where('barcode', $barcode);
            })
            ->first()?->product;
    }
}
