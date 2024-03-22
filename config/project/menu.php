<?php

return [
    'admin'     => [
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
                'measurement-units'  => [
                    'icon'       => 'activity',
                    'route_name' => 'admin.dictionaries.measurement-units.index',
                    'title'      => 'Единицы измерений',
                ],
                'countries'          => [
                    'icon'       => 'activity',
                    'route_name' => 'admin.dictionaries.countries.index',
                    'title'      => 'Страны',
                ],
                'positions'          => [
                    'icon'       => 'activity',
                    'route_name' => 'admin.dictionaries.positions.index',
                    'title'      => 'Позиции',
                ],
                'active-ingredients' => [
                    'icon'       => 'activity',
                    'route_name' => 'admin.dictionaries.active-ingredients.index',
                    'title'      => 'Действующие вещества',
                ],
                'suppliers'          => [
                    'icon'       => 'activity',
                    'route_name' => 'admin.dictionaries.suppliers.index',
                    'title'      => 'Поставщики',
                ],
                'products'           => [
                    'icon'       => 'activity',
                    'route_name' => 'admin.dictionaries.categories.index',
                    'title'      => 'Список товаров',
                ],
            ],
        ],
        'divider',
        'users'    => [
            'icon'       => 'activity',
            'route_name' => 'admin.users.index',
            'title'      => 'Пользователи',
        ],
        'warehouses'   => [
            'icon'       => 'home',
            'route_name' => 'admin.warehouses.index',
            'title'      => 'Склад',
        ],
        'divider',
        'outlets'      => [
            'icon'       => 'home',
            'route_name' => 'admin.outlets.index',
            'title'      => 'Торговая точка',
        ],
    ],
    'warehouse' => [
        'dashboard' => [
            'icon'       => 'home',
            'route_name' => 'dashboard',
            'title'      => 'Dashboard',
        ],
        'products'  => [
            'icon'       => 'list',
            'route_name' => 'warehouse.products.index',
            'title'      => 'Товары',
        ],
        'receipts'  => [
            'icon'       => 'list',
            'route_name' => 'warehouse.receipts.index',
            'title'      => 'Приход товаров',
        ],
        'sales'     => [
            'icon'       => 'list',
            'route_name' => 'warehouse.sales.index',
            'title'      => 'Продажа',
        ],
        'movements' => [
            'icon'       => 'list',
            'route_name' => 'warehouse.movements.index',
            'title'      => 'Перемещение товаров',
        ],
        'utilizations' => [
            'icon'       => 'list',
            'route_name' => 'warehouse.utilizations.index',
            'title'      => 'Утилизация товаров',
        ],
    ],
    'vendor'    => [
        'dashboard' => [
            'icon'       => 'home',
            'route_name' => 'dashboard',
            'title'      => 'Dashboard',
        ],
        'divider',
        'products'  => [
            'icon'       => 'list',
            'route_name' => 'vendor.products.index',
            'title'      => 'Товары',
        ],
        'sales'     => [
            'icon'       => 'list',
            'route_name' => 'vendor.sales.index',
            'title'      => 'Продажа',
        ],
        'receipts'  => [
            'icon'       => 'list',
            'route_name' => 'vendor.receipts.index',
            'title'      => 'Приход товаров',
        ],
        'returns' => [
            'icon'     => 'list',
            'title'    => 'Возврат',
            'sub_menu' => [
                'returns-warehouse'  => [
                    'icon'       => 'list',
                    'route_name' => 'vendor.returns-warehouse.index',
                    'title'      => 'Возврат товара на склад',
                ],
                'returns-vendor'  => [
                    'icon'       => 'list',
                    'route_name' => 'vendor.returns-vendor.index',
                    'title'      => 'Возврат товара от покупателя',
                ],
            ],
        ],
    ],
    'customs'   => [
        'dashboard' => [
            'icon'       => 'home',
            'route_name' => 'dashboard',
            'title'      => 'Dashboard',
        ],
        'receipts'  => [
            'icon'       => 'list',
            'route_name' => 'customs.receipts.index',
            'title'      => 'Приход товаров',
        ],
    ],
];
