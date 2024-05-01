<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use App\Models\Warehouse;
use App\StateMachines\StatusMovement;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    public function index(): View
    {
        $warehouses = Warehouse::get();

        $receipts = auth()->user()
            ->outlet
            ->receipts()
            ->filter(request()->only(['warehouse', 'from', 'to']))
            ->byStatus([StatusMovement::APPROVING, StatusMovement::APPROVED])
            ->with('model')
            ->withCount('products')
            ->latest()
            ->paginate(15);

        return view('vendor.receipts.index', compact('receipts', 'warehouses'));
    }

    public function show(Movement $receipt): View
    {
        return view('vendor.receipts.show', compact('receipt'));
    }

    public function approving(Movement $receipt): View
    {
        $this->authorize('approve', $receipt);

        return view('vendor.receipts.approving', compact('receipt'));
    }

    public function edit(Movement $receipt): View
    {
        $receipt->load('products.dicProduct.measure', 'products.product');

        return view('vendor.receipts.edit', compact('receipt'));
    }
}
