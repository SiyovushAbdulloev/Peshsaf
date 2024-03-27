<?php

namespace App\Actions\Warehouse\Reports;

use App\Core\Actions\CoreAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GetRemainsAction extends CoreAction
{
    public function handle(int|null $pagination = null, array $filters = []): LengthAwarePaginator|Collection
    {
        $remains = auth()->user()
            ->warehouse
            ->remainProducts()
            ->filter($filters)
            ->with('product', 'dicProduct.measure')
            ->latest();

        if (!is_null($pagination)) {
            $remains = $remains->paginate($pagination);
        } else {
            $remains = $remains->get();
        }

        return $remains;
    }
}
