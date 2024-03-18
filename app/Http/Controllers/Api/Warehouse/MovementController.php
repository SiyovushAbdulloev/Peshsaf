<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Warehouse\Movement\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movement\StoreRequest;
use App\Http\Resources\MovementResource;
use App\Http\Resources\OutletResource;
use App\Http\Resources\ProductResource;
use App\Models\Movement;
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

        return response()->json([
            'movements' => MovementResource::collection($movements)
        ]);
    }

    public function create(): JsonResponse
    {
        $outlets  = Outlet::get();

        return response()->json([
            'outlets' => OutletResource::collection($outlets)
        ]);
    }

    public function products(Request $request): JsonResponse
    {
        $product = Product::firstWhere('barcode', $request->get('barcode'));

        return response()->json([
            'product' => $product ? ProductResource::make($product->load('product')) : '',
        ]);
    }

    public function store(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $action->execute($request->getParams());

        return response()->json([
            'message' => 'Перемешение создано'
        ]);
    }
}
