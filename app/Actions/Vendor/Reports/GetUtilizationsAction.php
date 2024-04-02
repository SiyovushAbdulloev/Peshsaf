<?php

namespace App\Actions\Vendor\Reports;

use App\Core\Actions\CoreAction;
use App\Models\Outlet;
use App\Models\UtilizationProduct;
use Illuminate\Database\Eloquent\Builder;

class GetUtilizationsAction extends CoreAction
{
    public function handle(array $filters = []): Builder
    {
        $utilizationProducts = UtilizationProduct::whereHas('utilization', function (Builder $query) use ($filters) {
            $query
                ->where('model_type', Outlet::class)
                ->where('model_id', auth()->user()->outlet_id)
                ->filter($filters);
        })
            ->with('utilization', 'product', 'dicProduct');

        return $utilizationProducts;
    }
}
