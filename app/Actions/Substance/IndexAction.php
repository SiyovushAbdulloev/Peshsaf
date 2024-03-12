<?php

namespace App\Actions\Substance;

use App\Core\Actions\CoreAction;
use App\Models\Dictionaries\ActiveIngredient;
use Illuminate\Database\Eloquent\Collection;

class IndexAction extends CoreAction
{
    public function handle(): Collection
    {
        return ActiveIngredient::get();
    }
}
