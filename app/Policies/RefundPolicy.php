<?php

namespace App\Policies;

use App\Models\Refund;
use App\Models\User;

class RefundPolicy
{
    public function edit(User $user, Refund $refund): bool
    {
        return $refund->status()->is('draft');
    }
}
