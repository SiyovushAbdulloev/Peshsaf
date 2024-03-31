<?php

namespace App\Http\Controllers\Warehouse;

use App\Actions\Warehouse\Utilization\StoreAction;
use App\Actions\Warehouse\Utilization\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\Utilization\StoreRequest;
use App\Http\Requests\Warehouse\Utilization\UpdateRequest;
use App\Models\Client;
use App\Models\Outlet;
use App\Models\Utilization;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UtilizationController extends Controller
{
    public function index(): View
    {
        $utilizations = auth()->user()
            ->warehouse
            ->utilizations()
            ->with('client', 'outlet')
            ->withCount('products')
            ->latest()
            ->paginate(10);

        return view('warehouse.utilizations.index', compact('utilizations'));
    }

    public function show(Utilization $utilization): View
    {
        return view('warehouse.utilizations.show', compact('utilization'));
    }

    public function create(): View
    {
        $utilization = new Utilization;

        return view('warehouse.utilizations.create', compact('utilization'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $utilization = $action->execute($request->getParams());

        return redirect(route('warehouse.utilizations.edit', compact('utilization')))->with('success',
            'Утилизация успешно добавлена');
    }

    public function edit(Utilization $utilization): View
    {
        $outlets = Outlet::get();
        $clients = Client::get();

        return view('warehouse.utilizations.edit', compact('utilization', 'outlets', 'clients'));
    }

    public function update(
        Utilization $utilization,
        UpdateRequest $request,
        UpdateAction $action
    ): RedirectResponse {
        $action->execute($request->getParams(), $utilization);

        return redirect(route('warehouse.utilizations.edit', compact('utilization')))->with('success',
            'Данные успешно сохранены');
    }

    public function destroy(Utilization $utilization): RedirectResponse
    {
        $utilization->delete();

        return redirect(route('warehouse.utilizations.index'))->with('success', 'Утилизация успешно удалена');
    }
}
