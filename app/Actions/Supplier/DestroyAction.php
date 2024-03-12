<?php

namespace App\Actions\Supplier;

use App\Core\Actions\CoreAction;
use App\Models\Supplier;

class DestroyAction extends CoreAction
{
    public function handle(Supplier $supplier)
    {
        $supplier->delete();
    }
}
