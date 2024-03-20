<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    public function index(): View
    {
        $receipts = auth()->user()
            ->outlet
            ->movements()
            ->with('warehouse')
            ->withCount('products')
            ->latest()
            ->paginate(15);

        return view('vendor.receipts.index', compact('receipts'));
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
