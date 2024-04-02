<?php

namespace App\Actions\Vendor\Reports;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\StateMachines\StatusProduct;
use Illuminate\Database\Eloquent\Builder;

class GetSalesAction extends CoreAction
{
    public function handle(array $filters = []): Builder
    {
        return Product::where('creator_id', auth()->id())
            ->active()
            ->byStatus(StatusProduct::SOLD)
            ->filter($filters)
            ->with('product', 'sale')
            ->latest();
    }
}
