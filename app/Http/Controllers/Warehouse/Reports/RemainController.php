<?php

namespace App\Http\Controllers\Warehouse\Reports;

use App\Actions\Warehouse\Reports\GetRemainsAction;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class RemainController extends Controller
{
    public function index(GetRemainsAction $action): View
    {
        $remains = $action->execute(15);

        return view('warehouse.reports.remains', compact('remains'));
    }
}
