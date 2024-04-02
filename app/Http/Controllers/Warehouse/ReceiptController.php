<?php

namespace App\Http\Controllers\Warehouse;

use App\Actions\Warehouse\Receipt\StoreAction;
use App\Actions\Warehouse\Receipt\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Receipts\StoreRequest;
use App\Http\Requests\Receipts\UpdateRequest;
use App\Models\Dictionaries\Product;
use App\Models\Receipt;
use App\Models\Supplier;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ReceiptController extends Controller
{
    public function index(): View
    {
        $receipts = Receipt::query()
            ->withCount('products')
            ->latest()
            ->paginate(15);

        return view('warehouse.receipts.index', compact('receipts'));
    }

    public function create(): View
    {
        $receipt   = new Receipt;
        $suppliers = Supplier::get();
        $products  = Product::get();

        return view('warehouse.receipts.create', compact('receipt', 'suppliers', 'products'));
    }

    public function store(StoreRequest $request, StoreAction $action)
    {
        $receipt = $action->execute($request->getParams());

        return redirect(route('warehouse.receipts.edit', compact('receipt')))->with('success',
            'Приход успешно добавлен');
    }

    public function show(Receipt $receipt): View
    {
        $receipt
            ->load('supplier')
            ->loadCount('products');

        return view('warehouse.receipts.show', compact('receipt'));
    }

    public function edit(Receipt $receipt): View
    {
        $suppliers = Supplier::get();

        return view('warehouse.receipts.edit', compact('receipt', 'suppliers'));
    }

    public function update(
        Receipt $receipt,
        UpdateRequest $request,
        UpdateAction $action
    ) {
        $this->authorize('edit', $receipt);

        $action->execute($request->getParams(), $receipt);

        return redirect(route('warehouse.receipts.edit', compact('receipt')))->with('success',
            'Данные успешно сохранены');
    }

    public function destroy(Receipt $receipt): RedirectResponse
    {
        $receipt->delete();

        return redirect(route('warehouse.receipts.index'))->with('success', 'Приход успешно удален');
    }

    public function send(
        UpdateRequest $request,
        Receipt $receipt,
        UpdateAction $action
    ) {
        $this->authorize('edit', $receipt);

        $action->execute($request->getParams(), $receipt);
        if ($receipt->status()->canBe('on_approval')) {
            $receipt->status()->transitionTo('on_approval');
        }

        return redirect(route('warehouse.receipts.index'))->with('success', 'Приход успешно отправлен на одобрение');
    }
}
