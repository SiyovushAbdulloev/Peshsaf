<?php

namespace App\Http\Controllers\Warehouse\Reports;

use App\Actions\Warehouse\Reports\GetOutletsAction;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class OutletController extends Controller
{
    public function index(GetOutletsAction $action): View
    {
        $outletProducts = $action->execute(15);

        return view('warehouse.reports.outlets', compact('outletProducts'));
    }
}
