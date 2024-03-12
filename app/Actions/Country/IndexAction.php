<?php

namespace App\Actions\Country;

use App\Core\Actions\CoreAction;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class IndexAction extends CoreAction
{
    public function handle(): Collection
    {
        return Country::get();
    }
}
