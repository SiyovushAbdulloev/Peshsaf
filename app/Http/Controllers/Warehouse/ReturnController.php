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
        $filters = request()->only('from', 'to', 'option');
        $returns = auth()->user()
            ->warehouse
            ->returns()
            ->filter($filters)
            ->type(Refund::WAREHOUSE)
            ->byStatus([StatusReturn::PENDING, StatusReturn::FINISHED])
            ->withCount('products')
            ->with('origin')
            ->latest()
            ->paginate(15);
        $options = config('project.filter-dates.options');

        return view('warehouse.returns.index', compact('returns', 'options', 'filters'));
    }

    public function show(Refund $return): View
    {
        $return
            ->load('products.product.product.measure', 'origin', 'client', 'warehouse')
            ->loadCount('products');

        return view('warehouse.returns.show', compact('return'));
    }
}
