<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\OutletProduct;
use App\Models\Warehouse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $warehouses = Warehouse::get();
        $outlets = Outlet::get()->except(auth()->user()->outlet_id);

        $products = OutletProduct::with('product', 'dicProduct', 'model')
            ->filter(request()->only(['warehouse', 'outlet', 'from', 'to']))
            ->withCount('product')
            ->paginate(15);

        return view('vendor.products.index', compact('products', 'warehouses', 'outlets'));
    }
}
