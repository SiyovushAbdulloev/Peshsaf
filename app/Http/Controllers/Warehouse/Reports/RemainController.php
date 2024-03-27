<?php

namespace App\Http\Controllers\Warehouse\Reports;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RemainController extends Controller
{
    public function index(): View
    {
        $remains = auth()->user()
            ->warehouse
            ->remainProducts()
            ->with('product', 'dicProduct.measure')
            ->latest()
            ->paginate(15);

        return view('warehouse.reports.remains', compact('remains'));
    }

    public function export()
    {
        //
    }
}
