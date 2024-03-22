<?php

use App\Models\Role;

return [
    Role::ADMIN => [
        'description' => 'Админ',
    ],
    Role::WAREHOUSE => [
        'description' => 'Завсклад',
    ],
    Role::VENDOR => [
        'description' => 'Продавец',
    ],
    Role::CUSTOMS => [
        'description' => 'Таможня',
    ],
];
