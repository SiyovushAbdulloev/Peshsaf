<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Outlet\StoreAction;
use App\Actions\Outlet\UpdateAction;
use App\Exceptions\MethodNotImplementedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Outlet\StoreRequest;
use App\Models\Outlet;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OutletController extends Controller
{
    public function index(): View
    {
        $outlets = Outlet::get();

        return view('admin.outlets.index', compact('outlets'));
    }

    public function create(): View
    {
        $outlet = new Outlet();

        return view('admin.outlets.create', compact('outlet'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('admin.outlets.index'))->with('success', 'Торговая точка успешно создана');
    }

    public function edit(Outlet $outlet): View
    {
        return view('admin.outlets.edit', compact('outlet'));
    }

    public function update(
        StoreRequest $request,
        Outlet $outlet,
        UpdateAction $action
    ): RedirectResponse {
        $action->execute($request->getParams(), $outlet);

        return redirect(route('admin.outlets.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(Outlet $outlet): RedirectResponse
    {
        try {
            if (!$outlet->delete()) {
                throw new MethodNotImplementedException();
            }

            return redirect(route('admin.outlets.index'))->with('success', 'Торговая точка успешно удалена');
        } catch (\Throwable $e) {
            logger($e->getMessage());
        }
        return back()->with('error', 'Невозможно удалить торговую точку');
    }
}
