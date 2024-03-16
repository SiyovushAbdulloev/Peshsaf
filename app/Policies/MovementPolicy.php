<?php

namespace App\Policies;

use App\Models\Movement;
use App\Models\User;

class MovementPolicy
{
    public function edit(User $user, Movement $movement): bool
    {
        return $movement->status()->is('draft');
    }
}
