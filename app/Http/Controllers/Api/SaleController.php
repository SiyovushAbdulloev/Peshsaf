<?php

namespace App\Http\Controllers\Api;

use App\Actions\Warehouse\Sale\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\StoreRequest;
use App\Models\Client;
use App\Models\Role;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SaleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $clients = [];

        switch ($request->get('role')) {
            case Role::VENDOR:
                $clients = auth()->user()
                    ->outlet
                    ->sales()
                    ->with('client')
                    ->withCount('products')
                    ->paginate(15);
                break;
            case Role::WAREHOUSE:
                $clients = auth()->user()
                    ->warehouse;
//                    ->sales()
//                    ->with('client')
//                    ->withCount('products')
//                    ->paginate(15);
                break;
        }
dd($clients);
        return response()->json([
//            'clients' => ClientResource::collection($clients)
            'clients' => $clients
        ]);
    }

    public function create(Client $client = null): View
    {
        $sale = new Sale;

        return view('warehouse.sales.create', compact('sale', 'client'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('warehouse.sales.index'))->with('success', 'Продажа успешно оформлена');
    }

    public function clients(): View
    {
        return view('warehouse.sales.clients');
    }
}
