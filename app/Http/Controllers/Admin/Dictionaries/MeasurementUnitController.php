<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\MeasurementUnit\IndexAction;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class MeasurementUnitController extends Controller
{
    public function index(IndexAction $action): View
    {
        $units = $action->execute();

        return view('admin.dictionaries.measurement-units.index', compact('units'));
    }
}
