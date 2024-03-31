<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Actions\Vendor\Utilization\AddProductAction;
use App\Actions\Vendor\Utilization\StoreAction;
use App\Actions\Vendor\Utilization\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Utilization\ProductStoreRequest;
use App\Http\Requests\Vendor\Utilization\StoreRequest;
use App\Http\Requests\Vendor\Utilization\UpdateRequest;
use App\Http\Resources\Vendor\UtilizationResource;
use App\Models\Utilization;
use App\Models\UtilizationProduct;
use Illuminate\Http\JsonResponse;

class UtilizationController extends Controller
{
    public function index(): JsonResponse
    {
        $utilizations = auth()->user()
            ->outlet
            ->utilizations()
            ->with('client')
            ->withCount('products')
            ->latest()
            ->paginate(10);

        return response()->json(UtilizationResource::collection($utilizations));
    }

    public function store(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $utilization = $action->execute($request->getParams());

        return response()->json([
            'data' => UtilizationResource::make($utilization->load('client')->loadCount('products')),
        ]);
    }

    public function show(Utilization $utilization): JsonResponse
    {
        return response()->json([
            'data' => UtilizationResource::make($utilization->load('client', 'products')),
        ]);
    }

    public function update(
        Utilization $utilization,
        UpdateRequest $request,
        UpdateAction $action
    ): JsonResponse {
        $action->execute($request->getParams(), $utilization);

        return response()->json([
            'data' => UtilizationResource::make($utilization->load('client', 'products')),
        ]);
    }

    public function destroy(Utilization $utilization): JsonResponse
    {
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
            'data' => UtilizationResource::make($utilization->load('client')->loadCount('products')),
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
                    ->load('client', 'products')
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
                    ->load('client', 'products')
                    ->loadCount('products')
            ),
        ]);
    }
}
