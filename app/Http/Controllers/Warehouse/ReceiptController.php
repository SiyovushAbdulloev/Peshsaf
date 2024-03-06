<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reciepts\StoreRequest;
use App\Models\Dictionaries\Product;
use App\Models\Receipt;
use App\Models\Supplier;
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

    public function create(): View
    {
        $receipt = new Receipt;
        $suppliers = Supplier::get();
        $products = Product::get();

        return view('warehouse.receipts.create', compact('receipt', 'suppliers', 'products'));
    }

    public function store(StoreRequest $request)
    {
        $receipt = auth()->user()
            ->warehouse
            ->receipts()
            ->create($request->validated());

        foreach ($request->get('products') as $product) {
            $receipt->products()->create([
                'product_id' => $product
            ]);
        }

        return redirect(route('warehouse.receipts.index'))->with('success', 'Приход успешно добавлен');
    }
}
