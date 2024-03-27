<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Warehouse\GetProductAction;
use App\Actions\Warehouse\Sale\GetClientsAction;
use App\Actions\Warehouse\Sale\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\StoreRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SaleResource;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(): JsonResponse
    {
        $sales = auth()->user()
            ->warehouse
            ->sales()
            ->with('client')
            ->withCount('products')
            ->latest()
            ->paginate(5);

        return response()->json(SaleResource::collection($sales));
    }

    public function show(Sale $sale): JsonResponse
    {
        return response()->json(['data' => SaleResource::make($sale->load('products')->loadCount('products'))]);
    }

    public function clients(Request $request, GetClientsAction $action): JsonResponse
    {
        $clients = $action->execute($request->get('q'));

        if (!$clients) {
            return response()->json(['data' => []]);
        }

        return response()->json(ClientResource::collection($clients));
    }

    public function products(Request $request, GetProductAction $action): JsonResponse
    {
        $product = $action->execute($request->get('barcode'));

        if (!$product) {
            return response()->json(['data' => null]);
        }

        return response()->json(['data' => ProductResource::make($product->load('product', 'dicProduct'))]);
    }

    public function store(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $sale = $action->execute($request->getParams());

        return response()->json(['data' => SaleResource::make($sale->loadCount('products'))]);
    }
}
