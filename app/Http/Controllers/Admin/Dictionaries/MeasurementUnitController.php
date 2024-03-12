<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\MeasurementUnit\IndexAction;
use App\Actions\MeasurementUnit\StoreAction;
use App\Actions\MeasurementUnit\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MeasurementUnit\StoreRequest;
use App\Models\MeasurementUnit;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class MeasurementUnitController extends Controller
{
    public function index(IndexAction $action): View
    {
        $units = $action->execute();

        return view('admin.dictionaries.measurement-units.index', compact('units'));
    }

    public function create(): View
    {
        $unit = new MeasurementUnit;

        return view('admin.dictionaries.measurement-units.create', compact('unit'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('admin.dictionaries.measurement-units.index'))->with('success', 'Единица измерения добавлена');
    }

    public function edit(MeasurementUnit $unit): View
    {
        return view('admin.dictionaries.measurement-units.edit', compact('unit'));
    }

    public function update(
        StoreRequest $request,
        UpdateAction $action,
        MeasurementUnit $unit,
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $unit);

        return redirect(route('admin.dictionaries.measurement-units.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(MeasurementUnit $unit): RedirectResponse
    {
        try {
            $unit->delete();

            return redirect(route('admin.dictionaries.measurement-units.index'))->with('success', 'Данные успешно удалены');
        } catch (Throwable $e) {
            logger($e->getMessage());
        }

        return back()->with('error', 'Невозможно удалить запись');
    }
}
