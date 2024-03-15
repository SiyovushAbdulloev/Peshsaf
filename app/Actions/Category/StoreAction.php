<?php

namespace App\Actions\Category;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Category\StoreRequestParams;
use App\Models\Dictionaries\Category;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Category
    {
        return Category::create([
            'name' => $params->name
        ]);
    }
}
