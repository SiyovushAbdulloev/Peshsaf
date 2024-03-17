<?php

namespace App\Actions\Category;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Category\StoreRequestParams;
use App\Models\Dictionaries\Category;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Category $category): Category
    {
        $category->update([
            'name' => $params->name
        ]);

        return $category;
    }
}
