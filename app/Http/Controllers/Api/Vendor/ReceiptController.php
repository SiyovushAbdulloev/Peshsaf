<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Vendor\ReceiptResource;
use App\Models\Movement;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    public function index(): JsonResponse
    {
        $receipts = auth()->user()
            ->outlet
            ->movements()
            ->with('warehouse')
            ->withCount('products')
            ->latest()
            ->paginate(15);

        return response()->json([
            'receipts' => ReceiptResource::collection($receipts)
        ]);
    }

    public function show(Movement $receipt): JsonResponse
    {
        $receipt->load('warehouse');

        return response()->json([
            'receipt' => ReceiptResource::make($receipt)
        ]);
    }

    public function approving(Movement $receipt): JsonResponse
    {
        $this->authorize('approve', $receipt);

        $receipt->load('products.product.product.measure', 'warehouse');

        return response()->json([
            'receipt' => ReceiptResource::make($receipt)
        ]);
    }

    public function approve(Movement $receipt): View
    {
        //TODO: implement approve
    }
}
