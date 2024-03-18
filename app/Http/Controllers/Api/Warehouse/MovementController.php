<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Warehouse\GetProductsAction;
use App\Actions\Warehouse\Movement\AddProductAction;
use App\Actions\Warehouse\Movement\StoreAction;
use App\Actions\Warehouse\Movement\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movement\ProductStoreRequest;
use App\Http\Requests\Movement\StoreRequest;
use App\Http\Requests\Movement\UpdateRequest;
use App\Http\Resources\MovementResource;
use App\Http\Resources\OutletResource;
use App\Http\Resources\ProductResource;
use App\Models\Movement;
use App\Models\MovementProduct;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function index(): JsonResponse
    {
        $movements = Movement::query()
            ->with('outlet')
            ->withCount('products')
            ->latest()
            ->paginate(10);

        return response()->json(MovementResource::collection($movements));
    }

    public function show(Movement $movement): JsonResponse
    {
        return response()->json([
            'data' => MovementResource::make($movement->load('products.product', 'products.dicProduct')),
        ]);
    }

    public function outlets(): JsonResponse
    {
        $outlets = Outlet::get();

        return response()->json(OutletResource::collection($outlets));
    }

    public function products(Request $request, GetProductsAction $action): JsonResponse
    {
        $product = $action->execute($request->get('barcode'));

        if (!$product) {
            return response()->json(['data' => null]);
        }

        return response()->json(ProductResource::make($product->load('product')));
    }

    public function store(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $movement = $action->execute($request->getParams());

        return response()->json([
            'data' => MovementResource::make(
                $movement
                    ->load('outlet', 'products.product', 'products.dicProduct')
                    ->loadCount('products')
            ),
        ]);
    }

    public function update(
        Movement $movement,
        UpdateRequest $request,
        UpdateAction $action
    ) {
        $action->execute($request->getParams());

        return response()->json([
            'data' => MovementResource::make(
                $movement
                    ->load('outlet', 'products.product', 'products.dicProduct')
                    ->loadCount('products')
            ),
        ]);
    }

    public function addProduct(
        Movement $movement,
        AddProductAction $action,
        ProductStoreRequest $request
    ) {
        $action->execute($request->getParams(), $movement);

        return response()->json([
            'data' => MovementResource::make(
                $movement
                    ->load('outlet', 'products.product', 'products.dicProduct')
                    ->loadCount('products')
            ),
        ]);
    }

    public function removeProduct(Movement $movement, MovementProduct $movementProduct)
    {
        $movementProduct->delete();

        return response()->json([
            'data' => MovementResource::make(
                $movement
                    ->load('outlet', 'products.product', 'products.dicProduct')
                    ->loadCount('products')
            ),
        ]);
    }
}
