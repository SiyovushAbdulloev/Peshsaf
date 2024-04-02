<?php

namespace App\Http\Controllers;

use App\Actions\DeleteFileAction;
use App\Models\Dictionaries\Product;
use App\Models\File;

class ProductController extends Controller
{
    public function __invoke(Product $product)
    {
        return view('product', compact('product'));
    }
}
