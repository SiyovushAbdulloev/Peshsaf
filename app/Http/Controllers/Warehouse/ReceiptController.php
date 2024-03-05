<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\Supplier;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    public function index(): View
    {
        $receipts = Receipt::query()
            ->withCount('products')
            ->paginate(15);

        return view('warehouse.receipts.index', compact('receipts'));
    }

    public function create(): View
    {
        $receipt = new Receipt;
        $suppliers = Supplier::get();

        return view('warehouse.receipts.create', compact('receipt', 'suppliers'));
    }
}
