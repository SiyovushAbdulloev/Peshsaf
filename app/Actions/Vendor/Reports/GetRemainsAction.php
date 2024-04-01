<?php

namespace App\Actions\Vendor\Reports;

use App\Core\Actions\CoreAction;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GetRemainsAction extends CoreAction
{
    public function handle(array $filters = []): HasMany
    {
       return auth()->user()
            ->outlet
            ->products()
            ->filter($filters)
            ->with('product', 'dicProduct.measure')
            ->latest();
    }
}
