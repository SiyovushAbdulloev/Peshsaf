<?php

namespace App\Actions\Measure;

use App\Core\Actions\CoreAction;
use App\Models\Dictionaries\Measure;
use Illuminate\Database\Eloquent\Collection;

class IndexAction extends CoreAction
{
    public function handle(): Collection
    {
        return Measure::get();
    }
}
