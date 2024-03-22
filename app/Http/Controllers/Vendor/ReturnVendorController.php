<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use App\Models\Warehouse;
use Illuminate\View\View;

class ReturnVendorController extends Controller
{
    public function index(): View
    {
        $returns = auth()->user()
            ->outlet
            ->refunds()
//            ->count()
//            ->with('warehouse', 'origin')
            ->latest()
            ->paginate(15);

        return view('vendor.returns-vendor.index', compact('returns'));
    }

    public function show(Movement $receipt): View
    {
        return view('vendor.receipts.show', compact('receipt'));
    }

    public function edit(Movement $receipt): View
    {
        $receipt->load('products.dicProduct.measure', 'products.product');

        return view('vendor.receipts.edit', compact('receipt'));
    }

    public function send(Movement $receipt)
    {
        if ($receipt->status()->canBe('approving')) {
            $receipt->status()->transitionTo('approving');
        }

        foreach ($receipt->products as $product) {
            auth()->user()->outlet->products()->create([
                'product_id' => $product->product_id,
                'origin_id' => $receipt->warehouse_id,
                'origin_type' => Warehouse::class,
            ]);
        }

        return redirect(route('vendor.receipts.index'))->with('success', 'Приход успешно отправлен на одобрение');
    }
}
