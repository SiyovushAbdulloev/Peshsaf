<?php

namespace App\Actions\Analitics;

use App\Core\Actions\CoreAction;
use App\StateMachines\StatusMovement;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class GetVendorViewAction extends CoreAction
{
    public function handle(): View
    {
        $outlet = auth()->user()->outlet;
        $year   = Carbon::now()->year;
        $months = [
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь',
        ];

        $receipts = $outlet
            ->movements()
            ->byStatus([StatusMovement::APPROVING, StatusMovement::APPROVED])
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) month, COUNT(*) count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $sales = $outlet
            ->sales()
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) month, COUNT(*) count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $utilizations = $outlet
            ->utilizations()
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) month, COUNT(*) count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $receipts     = $this->getData($months, $receipts);
        $sales        = $this->getData($months, $sales);
        $utilizations = $this->getData($months, $utilizations);

        return view('dashboards.vendor', compact('months', 'receipts', 'sales', 'utilizations'));
    }

    private function getData($months, $data): array
    {
        collect($months)->each(function ($month, $key) use (&$arr, $data) {
            $arr[] = Arr::get($data, $key + 1, 0);
        });

        return $arr;
    }
}
