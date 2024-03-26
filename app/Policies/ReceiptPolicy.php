<?php

namespace App\Policies;

use App\Models\Receipt;
use App\Models\Role;
use App\Models\User;
use App\StateMachines\StatusReceipt;

class ReceiptPolicy
{
    public function edit(User $user, Receipt $receipt): bool
    {
        return $receipt->status()->is('draft');
    }

    public function confirm(User $user, Receipt $receipt): bool
    {
        return $receipt->status()->is(StatusReceipt::ON_APPROVAL) && auth()->user()->role->name === Role::CUSTOMS;
    }

    public function generate(User $user, Receipt $receipt): bool
    {
        return $receipt->status()->is(StatusReceipt::APPROVED) || $receipt->filepath;
    }
}
