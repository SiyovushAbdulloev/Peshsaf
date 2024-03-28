<?php

namespace App\Http\Controllers\Warehouse\Reports;

use App\Actions\Warehouse\Reports\ExportOutletsAction;
use App\Actions\Warehouse\Reports\GetOutletsAction;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OutletController extends Controller
{
    public function index(GetOutletsAction $action, ExportOutletsAction $exportAction): View|StreamedResponse
    {
        $filters = request()->only(['from', 'to', 'option']);
        $query = $action->execute($filters);

        if (request()->get('export')) {
            $callback = function () use ($exportAction, $query) {
                $writer = $exportAction->execute($query->get());
                $writer->save('php://output');
            };

            return response()->stream($callback, 200, [
                'Content-type'        => 'application/vnd.ms-excel',
                'Content-Disposition' => 'attachment; filename=outlets-report.xls',
                'Pragma'              => 'no-cache',
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
                'Expires'             => '0',
            ]);
        }

        $outletProducts = $query->paginate(15);
        $options = config('project.filter-dates.options');

        return view('warehouse.reports.outlets', compact('outletProducts', 'filters', 'options'));
    }
}
