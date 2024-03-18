<?php

namespace App\Http\Controllers\Warehouse;

use App\Actions\Utilization\FinishAction;
use App\Actions\Warehouse\Utilization\StoreAction;
use App\Actions\Warehouse\Utilization\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Utilization\StoreRequest;
use App\Http\Requests\Utilization\UpdateRequest;
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
            ->with('client')
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
        $outlets     = Outlet::get();

        return view('warehouse.utilizations.create', compact('utilization', 'outlets'));
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

        return view('warehouse.utilizations.edit', compact('utilization', 'outlets'));
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

    public function finish(Utilization $utilization, FinishAction $action): RedirectResponse
    {
        $action->execute($utilization);

        return redirect(route('warehouse.utilizations.index'))->with('success', 'Утилизация успешно проведена');
    }
}
