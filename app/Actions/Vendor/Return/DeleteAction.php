<?php

namespace App\Actions\Vendor\Return;

use App\Core\Actions\CoreAction;
use App\Models\Refund;

class DeleteAction extends CoreAction
{
    public function handle(Refund $return): void
    {
        $return->products()->delete();
        $return->delete();
    }
}
