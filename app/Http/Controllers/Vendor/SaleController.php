<?php

namespace App\Http\Controllers\Vendor;

use App\Actions\Warehouse\Sale\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\StoreRequest;
use App\Models\Client;
use App\Models\Sale;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SaleController extends Controller
{
    public function index(): View
    {
        $sales = auth()->user()
            ->outlet
            ->sales()
            ->with('client')
            ->withCount('products')
            ->paginate(15);

        return view('vendor.sales.index', compact('sales'));
    }

    public function create(Client $client = null): View
    {
        $sale = new Sale;

        return view('vendor.sales.create', compact('sale', 'client'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('vendor.sales.index'))->with('success', 'Продажа успешно оформлена');
    }

    public function show(Sale $sale): View
    {
        $sale = $sale->load('products.dicProduct.measure', 'products.product');
        return view('vendor.sales.show', compact('sale'));
    }

    public function clients(): View
    {
        return view('vendor.sales.clients');
    }
}
