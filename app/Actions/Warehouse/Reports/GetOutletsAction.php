<?php

namespace App\Actions\Warehouse\Reports;

use App\Core\Actions\CoreAction;
use App\Models\OutletProduct;
use Illuminate\Database\Eloquent\Builder;

class GetOutletsAction extends CoreAction
{
    public function handle(array $filters): Builder
    {
        return OutletProduct::where('warehouse_id', auth()->user()->warehouse_id)
            ->filter($filters)
            ->with('product', 'dicProduct', 'outlet');
    }
}
