<?php

namespace App\Actions\Vendor\Sale;

use App\Core\Actions\CoreAction;
use App\Models\OutletProduct;
use Illuminate\Database\Eloquent\Builder;

class GetProductAction extends CoreAction
{
    public function handle(string $barcode): ?OutletProduct
    {
        return OutletProduct::whereHas('product', function (Builder $query) use ($barcode) {
            $query->active()->where('barcode', $barcode);
        })
            ->first();
    }
}
