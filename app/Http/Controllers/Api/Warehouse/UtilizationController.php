<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Utilization\AddProductAction;
use App\Actions\Warehouse\GetProductAction;
use App\Actions\Warehouse\Utilization\StoreAction;
use App\Actions\Warehouse\Utilization\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Utilization\ProductStoreRequest;
use App\Http\Requests\Warehouse\Utilization\StoreRequest;
use App\Http\Requests\Warehouse\Utilization\UpdateRequest;
use App\Http\Resources\Warehouse\ProductResource;
use App\Http\Resources\Warehouse\UtilizationResource;
use App\Models\Product;
use App\Models\Utilization;
use App\Models\UtilizationProduct;
use App\StateMachines\StatusProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UtilizationController extends Controller
{
    public function index(): JsonResponse
    {
        $utilizations = auth()->user()
            ->warehouse
            ->utilizations()
            ->with('client', 'outlet')
            ->withCount('products')
            ->latest()
            ->paginate(10);

        return response()->json(UtilizationResource::collection($utilizations));
    }

    public function products(Request $request, GetProductAction $action): JsonResponse
    {
        $product = Product::query()
            ->active()
            ->where('status', StatusProduct::SOLD)
            ->where('barcode', $request->get('barcode'))
            ->first();

        if (!$product) {
            return response()->json(['data' => null]);
        }

        return response()->json(['data' => ProductResource::make($product->load('product.measure'))]);
    }

    public function store(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $utilization = $action->execute($request->getParams());

        return response()->json([
            'data' => UtilizationResource::make($utilization->load('client', 'outlet')->loadCount('products')),
        ]);
    }

    public function show(Utilization $utilization): JsonResponse
    {
        return response()->json([
            'data' => UtilizationResource::make($utilization->load('client', 'outlet', 'products')),
        ]);
    }

    public function update(
        Utilization $utilization,
        UpdateRequest $request,
        UpdateAction $action
    ): JsonResponse {
        $this->authorize('edit', $utilization);

        $action->execute($request->getParams(), $utilization);

        return response()->json([
            'data' => UtilizationResource::make($utilization->load('client', 'outlet')),
        ]);
    }

    public function addProduct(
        Utilization $utilization,
        AddProductAction $action,
        ProductStoreRequest $request
    ) {
        $action->execute($request->getParams(), $utilization);

        return response()->json([
            'data' => UtilizationResource::make(
                $utilization
                    ->load('client', 'outlet', 'products')
                    ->loadCount('products')
            ),
        ]);
    }

    public function removeProduct(Utilization $utilization, UtilizationProduct $utilizationProduct): JsonResponse
    {
        $utilizationProduct->delete();

        return response()->json([
            'data' => UtilizationResource::make(
                $utilization
                    ->load('client', 'outlet', 'products')
                    ->loadCount('products')
            ),
        ]);
    }

    public function destroy(Utilization $utilization): JsonResponse
    {
        $this->authorize('edit', $utilization);

        $utilization->delete();

        return response()->json([
            'success' => 'Утилизация успешно удалена',
        ]);
    }

    public function finish(Utilization $utilization): JsonResponse
    {
        if ($utilization->status()->canBe('finished')) {
            $utilization->status()->transitionTo('finished');
        }

        return response()->json([
            'data' => UtilizationResource::make($utilization->load('client', 'outlet')),
        ]);
    }
}
