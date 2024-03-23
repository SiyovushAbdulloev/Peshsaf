<?php

namespace App\Policies;

use App\Models\Movement;
use App\Models\Role;
use App\Models\User;

class MovementPolicy
{
    public function edit(User $user, Movement $movement): bool
    {
        return $movement->status()->is('draft');
    }

    public function approve(User $user, Movement $receipt): bool
    {
        return $receipt->status()->is('approving') && $user->role->name === Role::VENDOR;
    }
}
