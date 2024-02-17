<?php

return [
    'dashboard'    => [
        'icon'       => 'home',
        'route_name' => 'dashboard',
        'title'      => 'Dashboard',
    ],
    'divider',
    'dictionaries' => [
        'icon'     => 'library',
        'title'    => 'Справочники',
        'sub_menu' => [
            'measurments' => [
                'icon'       => 'activity',
                'route_name' => 'dictionaries.measurments.index',
                'title'      => 'Единицы измерений',
            ],
        ],
    ],
];
