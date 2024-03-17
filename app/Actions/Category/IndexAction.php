<?php

namespace App\Actions\Category;

use App\Core\Actions\CoreAction;
use App\Models\Dictionaries\Category;
use Illuminate\Database\Eloquent\Collection;

class IndexAction extends CoreAction
{
    public function handle(): Collection
    {
        return Category::get();
    }
}
