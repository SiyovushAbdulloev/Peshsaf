<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Actions\Vendor\Receipt\ApproveAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Vendor\ReceiptResource;
use App\Models\Movement;
use Illuminate\Http\JsonResponse;

class ReceiptController extends Controller
{
    public function index(): JsonResponse
    {
        $receipts = auth()->user()
            ->outlet
            ->movements()
            ->filter(request()->only('from', 'to', 'warehouse'))
            ->with('warehouse')
            ->withCount('products')
            ->latest()
            ->paginate(15);

        return response()->json(ReceiptResource::collection($receipts));
    }

    public function show(Movement $receipt): JsonResponse
    {
        $receipt->load('warehouse');

        return response()->json([
            'data' => ReceiptResource::make($receipt->load('products')->loadCount('products')),
        ]);
    }

    public function approve(Movement $receipt, ApproveAction $action): JsonResponse
    {
        $this->authorize('approve', $receipt);

        if ($receipt->status()->canBe('approved')) {
            $receipt->status()->transitionTo('approved');
        }

        return response()->json([
            'data' => ReceiptResource::make(
                $action->execute($receipt)
                    ->load('products')
                    ->loadCount('products')
            ),
        ]);
    }
}
