@extends('layouts.sidebar')

@section('subhead')
    <title>Dashboard</title>
@endsection

@section('content')
    <div class="intro-y mt-8">
        <h2 class="mr-auto text-lg font-medium">This is a dashboard</h2>
    </div>

    <div>
        <canvas id="myChart"></canvas>
    </div>
@endsection

@pushOnce('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($months) !!},
                datasets: [
                    {
                        label: 'Приходы',
                        data: {!! $receipts->map(function ($receipt) {
                                    return $receipt['count'];
                              }) !!},
                        borderWidth: 1
                    },
                    {
                        label: 'Перемещения',
                        data: {!! $movements->map(function ($movement) {
                                    return $movement['count'];
                              }) !!},
                        borderWidth: 1
                    },
                    {
                        label: 'Продажи',
                        data: {!! $sales->map(function ($sale) {
                                    return $sale['count'];
                              }) !!},
                        borderWidth: 1
                    },
                    {
                        label: 'Утилизации',
                        data: {!! $utilizations->map(function ($utilization) {
                                    return $utilization['count'];
                              }) !!},
                        borderWidth: 1
                    },
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endPushOnce
