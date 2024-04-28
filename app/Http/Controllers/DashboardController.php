<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\Receipt;
use App\Models\Role;
use App\StateMachines\StatusMovement;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return match (auth()->user()->role->name) {
          Role::WAREHOUSE => $this->warehouse(),
          Role::VENDOR => $this->vendor()
        };
    }

    public function warehouse(): View
    {;
        $year = Carbon::now()->year;
        $months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

        $receipts = Receipt::query()
            ->whereYear('created_at', $year)
            ->select(\DB::raw('MONTH(created_at) as month'), \DB::raw('COUNT(*) as count'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function ($receipt) {
                return [
                    'month' => __(Carbon::createFromDate(null, $receipt->month, null)->monthName),
                    'count' => $receipt->count
                ];
            })->toArray();

        $movements = Movement::query()
            ->whereYear('created_at', $year)
            ->select(\DB::raw('MONTH(created_at) as month'), \DB::raw('COUNT(*) as count'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function ($receipt) {
                return [
                    'month' => __(Carbon::createFromDate(null, $receipt->month, null)->monthName),
                    'count' => $receipt->count
                ];
            })->toArray();

        $sales = auth()->user()
            ->warehouse
            ->sales()
            ->whereYear('created_at', $year)
            ->select(\DB::raw('MONTH(created_at) as month'), \DB::raw('COUNT(*) as count'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function ($receipt) {
                return [
                    'month' => __(Carbon::createFromDate(null, $receipt->month, null)->monthName),
                    'count' => $receipt->count
                ];
            })->toArray();

        $utilizations = auth()->user()
            ->warehouse
            ->utilizations()
            ->whereYear('created_at', $year)
            ->select(\DB::raw('MONTH(created_at) as month'), \DB::raw('COUNT(*) as count'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function ($receipt) {
                return [
                    'month' => __(Carbon::createFromDate(null, $receipt->month, null)->monthName),
                    'count' => $receipt->count
                ];
            })->toArray();

        $receipts = $this->setDataByMonths($months, $receipts);
        $movements = $this->setDataByMonths($months, $movements);
        $sales = $this->setDataByMonths($months, $sales);
        $utilizations = $this->setDataByMonths($months, $utilizations);

        return view('dashboards.warehouse', compact('receipts', 'months', 'movements', 'sales', 'utilizations'));
    }

    public function vendor(): View
    {;
        $year = Carbon::now()->year;
        $months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

        $receipts = auth()->user()
            ->outlet
            ->movements()
            ->byStatus([StatusMovement::APPROVING, StatusMovement::APPROVED])
            ->whereYear('created_at', $year)
            ->select(\DB::raw('MONTH(created_at) as month'), \DB::raw('COUNT(*) as count'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function ($receipt) {
                return [
                    'month' => __(Carbon::createFromDate(null, $receipt->month, null)->monthName),
                    'count' => $receipt->count
                ];
            })->toArray();

        $sales = auth()->user()
            ->outlet
            ->sales()
            ->whereYear('created_at', $year)
            ->select(\DB::raw('MONTH(created_at) as month'), \DB::raw('COUNT(*) as count'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function ($receipt) {
                return [
                    'month' => __(Carbon::createFromDate(null, $receipt->month, null)->monthName),
                    'count' => $receipt->count
                ];
            })->toArray();

        $utilizations = auth()->user()
            ->outlet
            ->utilizations()
            ->whereYear('created_at', $year)
            ->select(\DB::raw('MONTH(created_at) as month'), \DB::raw('COUNT(*) as count'))
            ->groupBy(\DB::raw('MONTH(created_at)'))
            ->get()
            ->map(function ($receipt) {
                return [
                    'month' => __(Carbon::createFromDate(null, $receipt->month, null)->monthName),
                    'count' => $receipt->count
                ];
            })->toArray();

        $receipts = $this->setDataByMonths($months, $receipts);
        $sales = $this->setDataByMonths($months, $sales);
        $utilizations = $this->setDataByMonths($months, $utilizations);

        return view('dashboards.vendor', compact('receipts', 'months', 'sales', 'utilizations'));
    }

    private function setDataByMonths($months, $data): Collection
    {
        foreach ($months as $key => $month) {
            $exists = false;
            foreach ($data as $item) {
                if (mb_ucfirst($item['month']) === $month) {
                    $exists = true;
                }
            }
            if (!$exists) {
                $data = insertItemAtPosition($data, ['count' => 0, 'month' => $month], $key);
            }
        }

        return collect($data);
    }
}
