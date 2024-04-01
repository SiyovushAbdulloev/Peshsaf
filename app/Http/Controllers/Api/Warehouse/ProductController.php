<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Product\GetSoldProductAction;
use App\Actions\Warehouse\GetNewProductAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    public function new(GetNewProductAction $action, Request $request): ?JsonResponse
    {
        $product = $action->execute($request->get('barcode'));

        if (!$product) {
            return response()->json(['data' => null]);
        }

        return response()->json(['data' => ProductResource::make($product)]);
    }

    public function sold(GetSoldProductAction $action, Request $request): ?JsonResponse
    {
        $product = $action->execute($request->get('barcode'));
        if (!$product) {
            return response()->json(['data' => null]);
        }

        return response()->json([
            'data' => ProductResource::make($product),
        ]);
    }
}
