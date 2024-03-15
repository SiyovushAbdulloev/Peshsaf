<?php

namespace App\Actions\Product;

use App\Actions\DeleteFileAction;
use App\Core\Actions\CoreAction;
use App\Models\Dictionaries\Product;

class DestroyAction extends CoreAction
{
    public function handle(Product $product)
    {
        foreach ($product->files as $file) {
            app(DeleteFileAction::class)->execute($file);
        }

        $product->files()->delete();
        $product->delete();
    }
}
