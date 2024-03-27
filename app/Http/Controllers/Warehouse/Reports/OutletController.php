<?php

namespace App\Http\Controllers\Warehouse\Reports;

use App\Http\Controllers\Controller;
use App\Models\OutletProduct;
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

    public function export()
    {
        //
    }
}
