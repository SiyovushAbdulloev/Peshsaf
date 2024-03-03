<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\WarehouseRemain;
use Illuminate\Http\Request;
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
}
