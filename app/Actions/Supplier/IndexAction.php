<?php

namespace App\Actions\Supplier;

use App\Core\Actions\CoreAction;
use App\Models\Dictionaries\Category;

class IndexAction extends CoreAction
{
    public function handle(Category $category): array
    {
        return [
            'categories' => Category::get(),
            'category_products' => $category->load('products')
        ];
    }
}
