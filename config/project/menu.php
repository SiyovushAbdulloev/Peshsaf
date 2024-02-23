<?php

return [
    'admin' => [
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
                'measurement-units' => [
                    'icon'       => 'activity',
                    'route_name' => 'admin.dictionaries.measurement-units.index',
                    'title'      => 'Единицы измерений',
                ],
            ],
        ],
    ],
    'warehouse' => [
        'dashboard'    => [
            'icon'       => 'home',
            'route_name' => 'dashboard',
            'title'      => 'Dashboard',
        ],
    ],
    'vendor' => [
        'dashboard'    => [
            'icon'       => 'home',
            'route_name' => 'dashboard',
            'title'      => 'Dashboard',
        ],
    ],
    'customs' => [
        'dashboard'    => [
            'icon'       => 'home',
            'route_name' => 'dashboard',
            'title'      => 'Dashboard',
        ],
    ],
];
