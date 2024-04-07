<?php

namespace App\Http\Controllers\Api\Vendor\Returns;

use App\Actions\Vendor\Return\AddProductAction;
use App\Actions\Vendor\Return\Client\StoreAction;
use App\Actions\Vendor\Return\Client\UpdateAction;
use App\Actions\Vendor\Return\DestroyAction;
use App\Actions\Vendor\Return\RemoveProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Return\Client\StoreRequest;
use App\Http\Requests\Return\Client\UpdateRequest;
use App\Http\Requests\Return\ProductStoreRequest;
use App\Http\Resources\ReturnResource;
use App\Models\Refund;
use App\Models\RefundProduct;
use Symfony\Component\HttpFoundation\JsonResponse;

class ClientController extends Controller
{
    public function index(): array
    {
        $returns = auth()->user()
            ->outlet
            ->returns()
            ->filter(request()->only('from', 'to'))
            ->type(Refund::CLIENT)
            ->withCount('products')
            ->with('client')
            ->latest()
            ->paginate();

        return ReturnResource::collection($returns);
    }

    public function show(Refund $return): JsonResponse
    {
        return response()->json([
            'data' => ReturnResource::make($return->load('client', 'products')->loadCount('products')),
        ]);
    }

    public function store(StoreRequest $request, StoreAction $action): JsonResponse
    {
        $return = $action->execute($request->getParams());

        return response()->json([
            'data' => ReturnResource::make($return->load('client', 'products')->loadCount('products')),
        ]);
    }

    public function update(
        Refund $return,
        UpdateRequest $request,
        UpdateAction $action
    ): JsonResponse {
        $this->authorize('edit', $return);

        $return = $action->execute($request->getParams(), $return);

        return response()->json([
            'data' => ReturnResource::make($return->load('client', 'products')->loadCount('products')),
        ]);
    }

    public function destroy(Refund $return, DestroyAction $action): JsonResponse
    {
        $this->authorize('edit', $return);

        $action->execute($return);

        return response()->json([
            'success' => 'Возврат успешно удален',
        ]);
    }

    public function addProduct(
        Refund $return,
        AddProductAction $action,
        ProductStoreRequest $request
    ): JsonResponse {
        $action->execute($request->getParams(), $return);

        return response()->json([
            'data' => ReturnResource::make($return->load('client', 'products')->loadCount('products')),
        ]);
    }

    public function removeProduct(
        Refund $return,
        RefundProduct $returnProduct,
        RemoveProductAction $action
    ): JsonResponse {
        $action->execute($returnProduct);

        return response()->json([
            'data' => ReturnResource::make($return->load('client', 'products')->loadCount('products')),
        ]);
    }

    public function finish(Refund $return): JsonResponse
    {
        $this->authorize('finish', $return);

        if ($return->status()->canBe('finished')) {
            $return->status()->transitionTo('finished');
        }

        return response()->json([
            'data' => ReturnResource::make($return->load('client', 'products')->loadCount('products')),
        ]);
    }
}
