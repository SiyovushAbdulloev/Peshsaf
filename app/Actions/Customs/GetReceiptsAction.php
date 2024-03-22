<?php

namespace App\Actions\Customs;

use App\Core\Actions\CoreAction;
use App\Models\Receipt;
use App\StateMachines\StatusReceipt;
use Illuminate\Pagination\LengthAwarePaginator;

class GetReceiptsAction extends CoreAction
{
    public function handle(): LengthAwarePaginator
    {
        return Receipt::query()
            ->byStatus([StatusReceipt::ON_APPROVAL, StatusReceipt::APPROVED, StatusReceipt::FINISHED])
            ->with('warehouse')
            ->withCount('products')
            ->latest()
            ->paginate();
    }
}
