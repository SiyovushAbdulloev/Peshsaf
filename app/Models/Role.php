<?php

namespace App\Models;

use Spatie\Permission\Models\Role as Model;

class Role extends Model
{
    const ADMIN = 'admin';

    const WAREHOUSE = 'warehouse';

    const VENDOR = 'vendor';

    const CUSTOMS = 'customs';
}
