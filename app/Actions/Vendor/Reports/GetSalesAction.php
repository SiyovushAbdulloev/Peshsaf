<?php

namespace App\Actions\Vendor\Reports;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class GetSalesAction extends CoreAction
{
    public function handle(array $filters = []): Builder
    {
        return Product::where('creator_id', auth()->id())
            ->active()
            ->filter($filters)
            ->with('product', 'saleProduct.sale')
            ->latest();
    }
}
