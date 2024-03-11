<?php

namespace App\Actions\Substance;

use App\Core\Actions\CoreAction;
use App\Models\Substance;
use Illuminate\Database\Eloquent\Collection;

class IndexAction extends CoreAction
{
    public function handle(): Collection
    {
        return Substance::get();
    }
}
