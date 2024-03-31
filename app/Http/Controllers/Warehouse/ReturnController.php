<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\StateMachines\StatusReturn;
use Illuminate\View\View;

class ReturnController extends Controller
{
    public function index(): View
    {
        $returns = auth()->user()
            ->warehouse
            ->returns()
            ->type(Refund::WAREHOUSE)
            ->byStatus([StatusReturn::PENDING, StatusReturn::FINISHED])
            ->withCount('products')
            ->with('origin')
            ->latest()
            ->paginate(15);

        return view('warehouse.returns.index', compact('returns'));
    }

    public function show(Refund $return): View
    {
        $return
            ->load('products.product.product.measure', 'origin', 'client', 'warehouse')
            ->loadCount('products');

        return view('warehouse.returns.show', compact('return'));
    }
}
