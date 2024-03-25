<?php

namespace App\Http\Controllers\Vendor\Returns;

use App\Actions\Vendor\Return\Warehouse\StoreAction;
use App\Actions\Vendor\Return\Warehouse\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Return\Warehouse\StoreRequest;
use App\Http\Requests\Return\Warehouse\UpdateRequest;
use App\Models\Movement;
use App\Models\Refund;
use App\Models\Warehouse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class WarehouseController extends Controller
{
    public function index(): View
    {
        $returns = auth()->user()
            ->outlet
            ->returns()
            ->type(Refund::WAREHOUSE)
            ->withCount('products')
            ->with('warehouse')
            ->latest()
            ->paginate();

        return view('vendor.returns.warehouse.index', compact('returns'));
    }

    public function show(Movement $receipt): View
    {
        return view('vendor.receipts.show', compact('receipt'));
    }

    public function create(): View
    {
        $return     = new Refund;
        $warehouses = Warehouse::get();

        return view('vendor.returns.warehouse.create', compact('return', 'warehouses'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('vendor.returns.warehouse.index'))->with('success', 'Возврат успешно добавлен');
    }

    public function edit(Refund $return): View
    {
        return view('vendor.returns.warehouse.edit', compact('return'));
    }

    public function update(
        Refund $return,
        UpdateRequest $request,
        UpdateAction $action
    ) {
        $return = $action->execute($request->getParams(), $return);

        return redirect(route('vendor.returns.warehouse.edit', compact('return')))->with('success',
            'Данные успешно изменены');
    }

    public function send(
        Refund $return,
        UpdateRequest $request,
        UpdateAction $action
    ) {
        $return = $action->execute($request->getParams(), $return);

        if ($return->status()->canBe('pending')) {
            $return->status()->transitionTo('pending');
        }

        return redirect(route('vendor.returns.warehouse.index'))->with('success',
            'Возврат успешно отправлен на одобрение');
    }
}
