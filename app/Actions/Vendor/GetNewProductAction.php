<?php

namespace App\Actions\Vendor;

use App\Core\Actions\CoreAction;
use App\Models\OutletProduct;
use App\Models\Product;
use App\StateMachines\StatusProduct;
use Illuminate\Database\Eloquent\Builder;

class GetNewProductAction extends CoreAction
{
    public function handle(string $barcode): ?Product
    {
        return OutletProduct::query()
            ->whereHas('product', function (Builder $query) use ($barcode) {
                $query
                    ->active()
                    ->where('status', StatusProduct::NEW)
                    ->where('barcode', $barcode);
            })
            ->first()?->product;
    }
}
