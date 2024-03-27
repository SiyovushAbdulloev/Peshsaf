<?php

return [
    'options' => [
        [
            'value' => 'day',
            'label' => 'Данные за текущий день',
            'from' => \Carbon\Carbon::now()->format('d-m-Y'),
            'to' => \Carbon\Carbon::now()->format('d-m-Y'),
        ],
        [
            'value' => 'week',
            'label' => 'Данные за текущую неделю',
            'from' => \Carbon\Carbon::now()->subWeek()->format('d-m-Y'),
            'to' => \Carbon\Carbon::now()->format('d-m-Y'),
        ],
        [
            'value' => 'month',
            'label' => 'Данные за текущий месяц',
            'from' => \Carbon\Carbon::now()->subMonth()->format('d-m-Y'),
            'to' => \Carbon\Carbon::now()->format('d-m-Y'),
        ],
        [
            'value' => 'year',
            'label' => 'Данные за текущий год',
            'from' => \Carbon\Carbon::now()->subYear()->format('d-m-Y'),
            'to' => \Carbon\Carbon::now()->format('d-m-Y'),
        ],
    ],
];
