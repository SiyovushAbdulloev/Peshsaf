<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Warehouse\Return\ApproveAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReturnResource;
use App\Models\Refund;
use App\StateMachines\StatusReturn;
use Illuminate\Http\JsonResponse;

class ReturnController extends Controller
{
    public function index(): JsonResponse
    {
        $returns = auth()->user()
            ->warehouse
            ->returns()
            ->filter(request()->only('from', 'to'))
            ->type(Refund::WAREHOUSE)
            ->byStatus([StatusReturn::PENDING, StatusReturn::FINISHED])
            ->withCount('products')
            ->with('origin')
            ->latest()
            ->paginate(10);

        return response()->json(ReturnResource::collection($returns));
    }

    public function show(Refund $return): JsonResponse
    {
        $return->load('products.product.product.measure', 'origin');

        return response()->json([
            'data' => ReturnResource::make($return),
        ]);
    }

    public function approve(Refund $return, ApproveAction $action): JsonResponse
    {
        $this->authorize('approve', $return);

        return response()->json([
            'data' => ReturnResource::make($action->execute($return)),
        ]);
    }
}
