<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OutletProduct;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = OutletProduct::with('product', 'dicProduct', 'warehouse')
            ->withCount('product')
            ->paginate(15);

        return view('vendor.products.index', compact('products'));
    }
}
