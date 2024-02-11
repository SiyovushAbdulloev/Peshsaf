<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\MeasurementUnit\IndexAction;
use App\Actions\MeasurementUnit\StoreAction;
use App\Http\Controllers\Controller;
use App\Models\MeasurementUnit;
use App\Http\Requests\MeasurementUnit\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

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

        return redirect(route('dictionaries.measurement-units.index'))->with('success', 'Единица измерения добавлена');
    }
}
