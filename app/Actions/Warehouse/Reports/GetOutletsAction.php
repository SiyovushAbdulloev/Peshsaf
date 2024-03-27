<?php

namespace App\Actions\Warehouse\Reports;

use App\Core\Actions\CoreAction;
use App\Models\OutletProduct;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GetOutletsAction extends CoreAction
{
    public function handle(int|null $pagination = null): LengthAwarePaginator|Collection
    {
        $outletProducts = OutletProduct::where('warehouse_id', auth()->user()->warehouse_id)
            ->with('product', 'dicProduct', 'outlet');

        if (!is_null($pagination)) {
            $outletProducts = $outletProducts->paginate($pagination);
        } else {
            $outletProducts = $outletProducts->get();
        }

        return $outletProducts;
    }
}
