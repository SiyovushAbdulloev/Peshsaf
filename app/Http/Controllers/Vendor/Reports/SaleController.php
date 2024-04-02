<?php

namespace App\Http\Controllers\Vendor\Reports;

use App\Actions\Vendor\Reports\ExportSalesAction;
use App\Actions\Vendor\Reports\GetSalesAction;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SaleController extends Controller
{
    public function index(GetSalesAction $action, ExportSalesAction $exportAction): View|StreamedResponse
    {
        $query = $action->execute(filters: request()->only(['from', 'to', 'option']));

        if (request()->get('export')) {
            $callback = function () use ($exportAction, $query) {
                $writer = $exportAction->execute($query->get());
                $writer->save('php://output');
            };

            return response()->stream($callback, 200, [
                'Content-type'        => 'application/vnd.ms-excel',
                'Content-Disposition' => 'attachment; filename=sales-report.xls',
                'Pragma'              => 'no-cache',
                'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
                'Expires'             => '0',
            ]);
        }

        $products = $query->paginate(15);
        $options = config('project.filter-dates.options');

        return view('vendor.reports.sales', compact('products', 'options'));
    }
}
