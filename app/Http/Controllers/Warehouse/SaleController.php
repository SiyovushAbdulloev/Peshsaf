<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
//use App\Http\Requests\Sales\StoreRequest;
use App\Models\Client;
use App\Models\Sale;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        $sales = auth()->user()
            ->warehouse
            ->sales()
            ->with('client')
            ->withCount('products')
            ->paginate(15);

        return view('warehouse.sales.index', compact('sales'));
    }

    public function create(Client $client = null): View
    {
        $sale = new Sale;

        return view('warehouse.sales.create', compact('sale', 'client'));
    }

    public function store(StoreRequest $request)
    {

        return redirect(route('warehouse.sales.edit'))->with('success', 'Приход успешно добавлен');
    }

    public function clients(): View
    {
        return view('warehouse.sales.clients');
    }
}
