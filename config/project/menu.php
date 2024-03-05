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
        'products'    => [
            'icon'       => 'list',
            'route_name' => 'warehouse.products.index',
            'title'      => 'Товары',
        ],
        'receipts'    => [
            'icon'       => 'list',
            'route_name' => 'warehouse.receipts.index',
            'title'      => 'Приход товаров',
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
