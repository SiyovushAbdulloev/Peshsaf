<?php

namespace App\Http\Controllers\Vendor;

use App\Actions\Vendor\Return\DeleteAction;
use App\Actions\Vendor\Return\StoreAction;
use App\Actions\Vendor\Return\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Return\StoreRequest;
use App\Models\Refund;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReturnWarehouseController extends Controller
{
    public function index(): View
    {
        $returns = auth()->user()
            ->outlet
            ->refunds()
            ->withCount('products')
            ->with('warehouse', 'origin')
            ->latest()
            ->paginate(15);

        return view('vendor.returns-warehouse.index', compact('returns'));
    }

    public function create(): View
    {
        $return = new Refund();

        return view('vendor.returns-warehouse.create', compact('return'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('vendor.returns-warehouse.index'))->with('success', 'Возврат успешно создан');
    }

    public function show(Refund $return): View
    {
        $return
            ->load('products.product.dicProduct.measure', 'warehouse', 'origin', 'client')
            ->loadCount('products');

        return view('vendor.returns-warehouse.show', compact('return'));
    }

    public function edit(Refund $return): View
    {
        $return
            ->load('products.product.dicProduct.measure', 'warehouse', 'origin')
            ->loadCount('products');

        return view('vendor.returns-warehouse.edit', compact('return'));
    }

    public function update(
        StoreRequest $request,
        Refund $return,
        UpdateAction $action
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $return);

        return redirect(route('vendor.returns-warehouse.index'))->with('success', 'Возврат успешно обновлен');
    }

    public function destroy(Refund $return, DeleteAction $action): RedirectResponse
    {
        $action->execute($return);

        return redirect(route('vendor.returns-warehouse.index'))->with('success', 'Возврат успешно удален');
    }
}
