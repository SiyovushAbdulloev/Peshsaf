<?php

namespace App\Actions\Analitics;

use App\Core\Actions\CoreAction;
use App\Models\Movement;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class GetWarehouseViewAction extends CoreAction
{
    public function handle(): View
    {
        $warehouse = auth()->user()->warehouse;
        $year      = Carbon::now()->year;
        $months    = [
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

        $receipts = $warehouse
            ->receipts()
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) month, COUNT(*) count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $movements = Movement::query()
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) month, COUNT(*) count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $sales = $warehouse
            ->sales()
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) month, COUNT(*) count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $utilizations = $warehouse
            ->utilizations()
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) month, COUNT(*) count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $receipts     = $this->getData($months, $receipts);
        $movements    = $this->getData($months, $movements);
        $sales        = $this->getData($months, $sales);
        $utilizations = $this->getData($months, $utilizations);

        return view('dashboards.warehouse', compact('months', 'receipts', 'movements', 'sales', 'utilizations'));
    }

    private function getData($months, $data): array
    {
        collect($months)->each(function ($month, $key) use (&$arr, $data) {
            $arr[] = Arr::get($data, $key + 1, 0);
        });

        return $arr;
    }
}
