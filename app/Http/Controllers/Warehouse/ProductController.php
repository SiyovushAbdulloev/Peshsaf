<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Dictionaries\Product;
use App\Models\WarehouseRemain;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = WarehouseRemain::with('product.measure')
            ->withCount('products')
            ->paginate(15);

        return view('warehouse.products.index', compact('products'));
    }
}
