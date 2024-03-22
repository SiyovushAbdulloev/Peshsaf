<?php

namespace App\Http\Controllers\Vendor;

use App\Actions\Vendor\Receipt\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Receipts\StoreRequest;
use App\Http\Requests\Receipts\UpdateRequest;
use App\Models\Dictionaries\Product;
use App\Models\Receipt;
use App\Models\Warehouse;
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

    public function create(): View
    {
        $receipt = new Receipt;
        $warehouses = Warehouse::get();
        $products = Product::get();

        return view('vendor.receipts.create', compact('receipt', 'warehouses', 'products'));
    }

    public function store(StoreRequest $request, StoreAction $action)
    {
        $receipt = $action->execute($request);

        return redirect(route('vendor.receipts.edit', compact('receipt')))->with('success', 'Приход успешно добавлен');
    }

    public function edit(Receipt $receipt): View
    {
        $warehouses = Warehouse::get();

        return view('vendor.receipts.edit', compact('receipt', 'warehouses'));
    }

    public function update(Receipt $receipt, UpdateRequest $request)
    {
        $receipt->update($request->validated());

        foreach ($request->get('products') as $key => $count) {
            $product = $receipt->products->find($key);
            $product->count = $count;
            $product->save();
        }

        return redirect(route('vendor.receipts.edit', compact('receipt')))->with('success', 'Данные успешно сохранены');
    }

    public function destroy(Receipt $receipt): bool
    {
        return $receipt->delete();
    }

    public function send(Receipt $receipt)
    {
        if ($receipt->status()->canBe('on_approval')) {
            $receipt->status()->transitionTo('on_approval');
        }

        return redirect(route('vendor.receipts.index'))->with('success', 'Приход успешно отправлен на одобрение');
    }
}
