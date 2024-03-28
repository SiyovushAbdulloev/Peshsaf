<?php

namespace App\Actions\Warehouse\Reports;

use App\Core\Actions\CoreAction;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class GetRemainsAction extends CoreAction
{
    public function handle(array $filters = []): HasManyThrough
    {
       return auth()->user()
            ->warehouse
            ->remainProducts()
            ->filter($filters)
            ->with('product', 'dicProduct.measure')
            ->latest();
    }
}
