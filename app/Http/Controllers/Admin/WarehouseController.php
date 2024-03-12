<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Warehouse\StoreAction;
use App\Actions\Warehouse\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\StoreRequest;
use App\Models\Warehouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WarehouseController extends Controller
{
    public function index(): View
    {
        $warehouses = Warehouse::get();

        return view('admin.warehouses.index', compact('warehouses'));
    }

    public function create(): View
    {
        $warehouse = new Warehouse();

        return view('admin.warehouses.create', compact('warehouse'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('admin.warehouses.index'))->with('success', 'Склад успешно создан');
    }

    public function edit(Warehouse $warehouse): View
    {
        return view('admin.warehouses.edit', compact('warehouse'));
    }

    public function update(
        StoreRequest $request,
        Warehouse $warehouse,
        UpdateAction $action
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $warehouse);

        return redirect(route('admin.warehouses.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(Warehouse $warehouse): RedirectResponse
    {
        $warehouse->delete();

        return redirect(route('admin.warehouses.index'))->with('success', 'Склад успешно удален');
    }
}
