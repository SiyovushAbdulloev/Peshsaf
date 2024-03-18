<?php

namespace App\Http\Controllers\Api;

use App\Actions\Warehouse\Movement\StoreAction;
use App\Actions\Warehouse\Movement\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Movement\StoreRequest;
use App\Http\Requests\Movement\UpdateRequest;
use App\Http\Resources\MovementResource;
use App\Http\Resources\OutletResource;
use App\Http\Resources\ProductResource;
use App\Models\Movement;
use App\Models\Outlet;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

    public function store(StoreRequest $request, StoreAction $action): bool
    {
        $action->execute($request->getParams());

        return true;
    }

    public function edit(Movement $movement): View
    {
        $outlets = Outlet::get();

        return view('warehouse.movements.edit', compact('movement', 'outlets'));
    }

    public function update(
        Movement $movement,
        UpdateRequest $request,
        UpdateAction $action
    ): RedirectResponse {
        $action->execute($request->getParams(), $movement);

        return redirect(route('warehouse.movements.edit', compact('movement')))->with('success',
            'Данные успешно сохранены');
    }

    public function destroy(Movement $movement): RedirectResponse
    {
        $movement->delete();

        return redirect(route('warehouse.movements.index'))->with('success', 'Перемещение успешно удалено');
    }

    public function send(Movement $movement): RedirectResponse
    {
        if ($movement->status()->canBe('approving')) {
            $movement->status()->transitionTo('approving');
        }

        return redirect(route('warehouse.movements.index'))->with('success', 'Перемещение успешно отправлено');
    }
}
