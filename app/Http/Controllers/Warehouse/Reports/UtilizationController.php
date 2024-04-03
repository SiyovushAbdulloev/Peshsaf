<?php

namespace App\Http\Controllers\Warehouse\Reports;

use App\Actions\Warehouse\Reports\ExportUtilizationsAction;
use App\Actions\Warehouse\Reports\GetUtilizationsAction;
use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UtilizationController extends Controller
{
    public function index(GetUtilizationsAction $action, ExportUtilizationsAction $exportAction): View|StreamedResponse
    {
        $query = $action->execute(filters: request()->only(['from', 'to', 'outlet', 'client']));

        if (request()->get('export')) {
            $callback = function () use ($exportAction, $query) {
                $writer = $exportAction->execute($query->get());
                $writer->save('php://output');
            };

            return response()->stream($callback, 200, [
                'Content-type'        => 'application/vnd.ms-excel',
                'Content-Disposition' => 'attachment; filename=utilizations-report.xls',
                'Pragma'              => 'no-cache',
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
                'Expires'             => '0',
            ]);
        }

        $utilizationProducts = $query->paginate(15);
        $outlets = Outlet::get();
        $options = config('project.filter-dates.options');

        return view('warehouse.reports.utilizations', compact('utilizationProducts', 'options', 'outlets'));
    }
}
