<?php

namespace App\Http\Controllers\Warehouse\Reports;

use App\Http\Controllers\Controller;
use App\Models\OutletProduct;
use App\Models\Receipt;
use App\Models\Supplier;
use Illuminate\View\View;

class OutletController extends Controller
{
    public function index(): View
    {
        $outletProducts = OutletProduct::where('warehouse_id', auth()->user()->warehouse_id)
            ->with('product', 'dicProduct', 'outlet')
            ->paginate(15);

        return view('warehouse.reports.outlets', compact('outletProducts'));
    }

    public function export(Receipt $receipt): View
    {
        $suppliers = Supplier::get();

        return view('warehouse.receipts.edit', compact('receipt', 'suppliers'));
    }
}
