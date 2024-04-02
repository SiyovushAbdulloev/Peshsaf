<?php

namespace App\Actions\Warehouse\Reports;

use App\Core\Actions\CoreAction;
use App\Models\UtilizationProduct;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Builder;

class GetUtilizationsAction extends CoreAction
{
    public function handle(array $filters = []): Builder
    {
        $utilizationProducts = UtilizationProduct::whereHas('utilization', function (Builder $query) use ($filters) {
            $query
                ->where('model_type', Warehouse::class)
                ->where('model_id', auth()->user()->warehouse_id)
                ->filter($filters);
        })
            ->with('utilization', 'product', 'dicProduct');

        return $utilizationProducts;
    }
}
