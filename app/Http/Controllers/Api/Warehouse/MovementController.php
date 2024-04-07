<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Warehouse\GetNewProductAction;
use App\Actions\Warehouse\Movement\AddProductAction;
use App\Actions\Warehouse\Movement\StoreAction;
use App\Actions\Warehouse\Movement\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movement\ProductStoreRequest;
use App\Http\Requests\Movement\StoreRequest;
use App\Http\Requests\Movement\UpdateRequest;
use App\Http\Resources\MovementResource;
use App\Http\Resources\Warehouse\Movement\ProductResource;
use App\Models\Movement;
use App\Models\MovementProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function index(): JsonResponse
    {
        $movements = Movement::query()
            ->with('outlet')
            ->withCount('products')
            ->filter(request()->only('from', 'to'))
            ->latest()
            ->paginate(10);

        return response()->json(MovementResource::collection($movements));
    }

    public function show(Movement $movement): JsonResponse
    {
        return response()->json([
            'data' => MovementResource::make($movement->load('products.product', 'products.dicProduct',
                'outlet')->loadCount('products')),
        ]);
    }

    public function products(Request $request, GetNewProductAction $action): JsonResponse
    {
        $product = $action->execute($request->get('barcode'));

        if (!$product) {
            return response()->json(['data' => null]);
        }

        return response()->json(['data' => ProductResource::make($product->load('product', 'dicProduct'))]);
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
        $action->execute($request->getParams(), $movement);

        return response()->json([
            'data' => MovementResource::make(
                $movement
                    ->load('outlet', 'products.product', 'products.dicProduct')
                    ->loadCount('products')
            ),
        ]);
    }

    public function destroy(Movement $movement): JsonResponse
    {
        $movement->delete();

        return response()->json([
            'success' => 'Перемещение успешно удалено',
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

    public function send(Movement $movement): JsonResponse
    {
        if ($movement->status()->canBe('approving')) {
            $movement->status()->transitionTo('approving');
        }

        return response()->json([
            'data' => MovementResource::make(
                $movement
                    ->load('outlet', 'products.product', 'products.dicProduct')
                    ->loadCount('products')
            ),
        ]);
    }
}
