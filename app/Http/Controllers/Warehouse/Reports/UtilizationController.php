<?php

namespace App\Http\Controllers\Warehouse\Reports;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\Supplier;
use App\Models\UtilizationProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;

class UtilizationController extends Controller
{
    public function index(): View
    {
        $utilizationProducts = UtilizationProduct::whereHas('utilization', function (Builder $query) {
            $query->where('model_id', auth()->user()->warehouse_id);
        })
            ->with('utilization', 'product', 'dicProduct')
            ->paginate(10);

        return view('warehouse.reports.utilizations', compact('utilizationProducts'));
    }

    public function export(Receipt $receipt): View
    {
        $suppliers = Supplier::get();

        return view('warehouse.receipts.edit', compact('receipt', 'suppliers'));
    }
}
