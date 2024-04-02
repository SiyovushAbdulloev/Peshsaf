<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\OutletProduct;
use App\Models\Warehouse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $warehouses = Warehouse::get();

        $products = OutletProduct::with('product', 'dicProduct', 'warehouse')
            ->filter(request()->only(['warehouse', 'from', 'to']))
            ->withCount('product')
            ->paginate(15);

        return view('vendor.products.index', compact('products', 'warehouses'));
    }
}
