<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Actions\Vendor\Return\AddProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Return\ProductStoreRequest;
use App\Http\Resources\ReturnResource;
use App\Models\Refund;
use App\Models\Utilization;
use App\Models\UtilizationProduct;
use Illuminate\Http\JsonResponse;

class ReturnController extends Controller
{
    public function addProduct(
        Refund $return,
        AddProductAction $action,
        ProductStoreRequest $request
    ): \Symfony\Component\HttpFoundation\JsonResponse {
        $action->execute($request->getParams(), $return);

        return response()->json([
            'data' => ReturnResource::make(
                $return
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
