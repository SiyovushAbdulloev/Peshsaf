<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Sale\StoreAction;
use App\Actions\Warehouse\GetProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sale\StoreRequest;
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

    public function products(Request $request, GetProductAction $action): JsonResponse
    {
        $warehouseProduct = $action->execute($request->get('barcode'));

        if (!$warehouseProduct) {
            return response()->json(['data' => null]);
        }

        return response()->json(['data' => ProductResource::make($warehouseProduct->product)]);
    }

    public function store(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $sale = $action->execute($request->getParams());

        return response()->json(['data' => SaleResource::make($sale->loadCount('products'))]);
    }
}
