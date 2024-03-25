<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Actions\Vendor\Return\UpdateAction;
use App\Actions\Warehouse\AddWarehouseProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Return\StoreRequest;
use App\Http\Resources\Warehouse\ReturnResource;
use App\Models\OutletProduct;
use App\Models\Product;
use App\Models\Refund;
use App\Models\RefundProduct;
use App\StateMachines\StatusReturn;
use Illuminate\Http\JsonResponse;

class ReturnController extends Controller
{
    public function index(): JsonResponse
    {
        $returns = auth()->user()
            ->warehouse
            ->returns()
            ->type(Refund::WAREHOUSE)
            ->byStatus([StatusReturn::PENDING, StatusReturn::FINISHED])
            ->withCount('products')
            ->with('origin')
            ->latest()
            ->paginate(15);

        return response()->json([
            'returns' => ReturnResource::collection($returns)
        ]);
    }

    public function show(Refund $return): JsonResponse
    {
        $return->load('products.product.product.measure', 'origin');

        return response()->json([
            'return' => ReturnResource::make($return)
        ]);
    }

    public function approve(Refund $return): JsonResponse
    {
        $products = RefundProduct::where('refund_id', $return->id)->get();

        foreach ($products as $p) {
            OutletProduct::where('product_id', $p->product_id)->delete();
            
            $product = Product::find($p->product_id);
            $newProduct = $product->replicate();
            $newProduct->model_type = Refund::class;
            $newProduct->model_id = $return->id;
            $newProduct->save();

            app(AddWarehouseProductAction::class)->execute($return->warehouse_id, $newProduct);

            $product->history = true;
            $product->save();
        }

        $return->status()->transitionTo(StatusReturn::FINISHED);

        return response()->json([
            'message' => 'Возврат успешно одобрен'
        ]);
    }
}
