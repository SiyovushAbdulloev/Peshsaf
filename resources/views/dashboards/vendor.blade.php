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
    new Chart(document.getElementById('myChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [
                {
                    label: 'Приходы',
                    data: {{ json_encode($receipts) }},
                    borderWidth: 1
                },
                {
                    label: 'Продажи',
                    data: {{ json_encode($sales) }},
                    borderWidth: 1
                },
                {
                    label: 'Утилизации',
                    data: {{ json_encode($utilizations) }},
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
