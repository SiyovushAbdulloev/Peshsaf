<?php

namespace App\Policies;

use App\Models\Receipt;
use App\Models\User;

class ReceiptPolicy
{
    public function edit(User $user, Receipt $receipt): bool
    {
        return $receipt->status()->is('draft');
    }
}
