<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        $sales = auth()->user()
            ->warehouse
            ->sales()
            ->with('client')
            ->withCount('products')
            ->paginate(15);

        return view('warehouse.sales.index', compact('sales'));
    }
}
