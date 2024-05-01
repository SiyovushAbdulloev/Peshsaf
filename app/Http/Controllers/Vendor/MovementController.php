<?php

namespace App\Http\Controllers\Vendor;

use App\Actions\Vendor\Movement\StoreAction;
use App\Actions\Vendor\Movement\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movement\StoreRequest;
use App\Http\Requests\Movement\UpdateRequest;
use App\Models\Movement;
use App\Models\Outlet;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MovementController extends Controller
{
    public function index(): View
    {
        $filters = request()->only('from', 'to', 'option');
        $movements = auth()->user()
            ->outlet
            ->movements()
            ->filter($filters)
            ->with('outlet')
            ->withCount('products')
            ->latest()
            ->paginate(10);
        $options = config('project.filter-dates.options');

        return view('vendor.movements.index', compact('movements', 'options', 'filters'));
    }

    public function create(): View
    {
        $movement = new Movement;
        $outlets  = Outlet::get()->except(auth()->user()->outlet_id);

        return view('vendor.movements.create', compact('movement', 'outlets'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $movement = $action->execute($request->getParams());

        return redirect(route('vendor.movements.edit', compact('movement')))->with('success',
            'Перемещение успешно создано');
    }

    public function show(Movement $movement): View
    {
        $movement->load('outlet', 'products.product', 'products.dicProduct');

        return view('vendor.movements.show', compact('movement'));
    }

    public function edit(Movement $movement): View
    {
        $outlets = Outlet::get();

        return view('vendor.movements.edit', compact('movement', 'outlets'));
    }

    public function update(
        Movement $movement,
        UpdateRequest $request,
        UpdateAction $action
    ): RedirectResponse {
        $action->execute($request->getParams(), $movement);

        return redirect(route('vendor.movements.edit', compact('movement')))->with('success',
            'Данные успешно сохранены');
    }

    public function destroy(Movement $movement): RedirectResponse
    {
        $movement->delete();

        return redirect(route('vendor.movements.index'))->with('success', 'Перемещение успешно удалено');
    }

    public function send(Movement $movement): RedirectResponse
    {
        if ($movement->status()->canBe('approving')) {
            $movement->status()->transitionTo('approving');
        }

        return redirect(route('vendor.movements.index'))->with('success', 'Перемещение успешно отправлено');
    }
}
