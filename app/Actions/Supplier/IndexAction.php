<?php

namespace App\Actions\Supplier;

use App\Core\Actions\CoreAction;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;

class IndexAction extends CoreAction
{
    public function handle(): Collection
    {
        return Supplier::with('country')->get();
    }
}
