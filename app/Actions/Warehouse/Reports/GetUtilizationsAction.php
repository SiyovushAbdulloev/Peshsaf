<?php

namespace App\Actions\Warehouse\Reports;

use App\Core\Actions\CoreAction;
use App\Models\UtilizationProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GetUtilizationsAction extends CoreAction
{
    public function handle(int|null $pagination = null): LengthAwarePaginator|Collection
    {
        $utilizationProducts = UtilizationProduct::whereHas('utilization', function (Builder $query) {
            $query->where('model_id', auth()->user()->warehouse_id);
        })
            ->with('utilization', 'product', 'dicProduct');

        if (!is_null($pagination)) {
            $utilizationProducts = $utilizationProducts->paginate($pagination);
        } else {
            $utilizationProducts = $utilizationProducts->get();
        }

        return $utilizationProducts;
    }
}
