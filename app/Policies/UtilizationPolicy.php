<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Utilization;

class UtilizationPolicy
{
    public function edit(User $user, Utilization $utilization): bool
    {
        return $utilization->status()->is('draft');
    }
}
