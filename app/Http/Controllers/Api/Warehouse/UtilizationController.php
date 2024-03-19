<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Utilization\FinishAction;
use App\Actions\Warehouse\Utilization\StoreAction;
use App\Actions\Warehouse\Utilization\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Utilization\StoreRequest;
use App\Http\Requests\Utilization\UpdateRequest;
use App\Http\Resources\Warehouse\UtilizationResource;
use App\Models\Utilization;
use Illuminate\Http\JsonResponse;

class UtilizationController extends Controller
{
    public function index(): JsonResponse
    {
        $utilizations = auth()->user()
            ->warehouse
            ->utilizations()
            ->with('client')
            ->with('outlet')
            ->withCount('products')
            ->latest()
            ->paginate(10);

        return response()->json([
            'utilizations' => UtilizationResource::collection($utilizations)
        ]);
    }

    public function store(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $utilization = $action->execute($request->getParams());

        return response()->json([
            'utilization' => UtilizationResource::make($utilization->load('client', 'outlet'))
        ]);
    }

    public function show(Utilization $utilization): JsonResponse
    {
        return response()->json([
            'utilization' => UtilizationResource::make($utilization->load('client', 'outlet'))
        ]);
    }

    public function update(
        Utilization $utilization,
        UpdateRequest $request,
        UpdateAction $action
    ): JsonResponse {
        $action->execute($request->getParams(), $utilization);

        return response()->json([
            'utilization' => UtilizationResource::make($utilization->load('client', 'outlet'))
        ]);
    }

    public function destroy(Utilization $utilization): JsonResponse
    {
        $utilization->delete();

        return response()->json([
            'success' => 'Утилизация успешно удалена'
        ]);
    }

    public function finish(Utilization $utilization, FinishAction $action): JsonResponse
    {
        $action->execute($utilization);

        return response()->json([
            'success' => 'Утилизация успешно проведена'
        ]);
    }
}
