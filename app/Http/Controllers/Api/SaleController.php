<?php

namespace App\Http\Controllers\Api;

use App\Actions\Warehouse\Sale\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\StoreRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SaleResource;
use App\Models\Client;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(): JsonResponse
    {
        $model = match (auth()->user()->role->name) {
            Role::VENDOR => auth()->user()->outlet,
            Role::WAREHOUSE => auth()->user()->warehouse,
        };

        return response()->json([
            'sales' => SaleResource::collection($model->sales()
                ->with('client')
                ->withCount('products')
                ->paginate(15)),
        ]);
    }

    public function clients(Request $request): JsonResponse
    {
        $clients = Client::filter(['q' => $request->get('q')])->get();

        return response()->json([
            'clients' => ClientResource::collection($clients),
        ]);
    }

    public function products(Request $request): JsonResponse
    {
        $product = Product::firstWhere('barcode', $request->get('barcode'));

        return response()->json([
            'product' => $product ? ProductResource::make($product->load('product')) : '',
        ]);
    }

    public function store(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $sale = $action->execute($request->getParams());

        return response()->json([
            'sale' => SaleResource::make($sale),
        ]);
    }
}
