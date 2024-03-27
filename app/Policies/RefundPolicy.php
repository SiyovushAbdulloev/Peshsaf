<?php

namespace App\Policies;

use App\Models\Refund;
use App\Models\User;

class RefundPolicy
{
    public function edit(User $user, Refund $return): bool
    {
        return $return->status()->is('draft');
    }

    public function approve(User $user, Refund $return): bool
    {
        return $user->warehouse_id === $return->warehouse_id && $return->status()->is('pending');
    }

    public function finish(User $user, Refund $return): bool
    {
        return $user->outlet->is($return->origin) && $return->status()->is('draft');
    }
}
