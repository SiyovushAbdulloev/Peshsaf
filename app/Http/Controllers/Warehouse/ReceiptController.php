<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reciepts\StoreRequest;
use App\Http\Requests\Reciepts\UpdateRequest;
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

        foreach ($request->get('products') as $productId) {
            $receipt->products()->create([
                'dic_product_id' => $productId
            ]);
        }

        return redirect(route('warehouse.receipts.edit', compact('receipt')))->with('success', 'Приход успешно добавлен');
    }

    public function edit(Receipt $receipt): View
    {
        $suppliers = Supplier::get();

        return view('warehouse.receipts.edit', compact('receipt', 'suppliers'));
    }

    public function update(Receipt $receipt, UpdateRequest $request)
    {
        $receipt->update($request->validated());

        foreach ($request->get('products') as $key => $count) {
            $product = $receipt->products->find($key);
            $product->count = $count;
            $product->save();
        }

        return redirect(route('warehouse.receipts.edit', compact('receipt')))->with('success', 'Данные успешно сохранены');
    }

    public function send(Receipt $receipt)
    {
        if ($receipt->status()->canBe('on_approval')) {
            $receipt->status()->transitionTo('on_approval');
        }

        return redirect(route('warehouse.receipts.index'))->with('success', 'Приход успешно отправлен на одобрение');
    }
}
