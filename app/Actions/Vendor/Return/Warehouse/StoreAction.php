<?php

namespace App\Actions\Vendor\Return\Warehouse;

use App\Actions\Warehouse\AddWarehouseProductAction;
use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Return\Warehouse\StoreRequestParams;
use App\Models\OutletProduct;
use App\Models\Product;
use App\Models\Refund;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): void
    {
        if ($params->distribute) {
            $warehouses = OutletProduct::query()
                ->whereIn('product_id', $params->products)
                ->get()
                ->groupBy('warehouse_id');

            foreach ($warehouses as $warehouseId => $outletProducts) {
                $this->createRefund($warehouseId, $outletProducts->pluck('product_id')->toArray(), $params);
            }
        } else {
            $this->createRefund($params->warehouseId, $params->products, $params);
        }
    }

    private function createRefund(int $warehouseId, array $products, StoreRequestParams $params = null): void
    {
        $return = auth()->user()
            ->outlet
            ->returns()
            ->create([
                'type'         => Refund::WAREHOUSE,
                'date'         => $params->date,
                'number'       => $params->number,
                'warehouse_id' => $warehouseId,
            ]);

        $this->createRefundProducts($return, $products);
    }

    private function createRefundProducts(Refund $return, array $products): void
    {
        foreach ($products as $productId) {
            $return->products()->create([
                'product_id' => $productId,
            ]);

            // TODO перенести код в конфирм возврата

//            $product = Product::find($outletProduct->product_id);
//            $newProduct             = $product->replicate();
//            $newProduct->model_type = Refund::class;
//            $newProduct->model_id   = $return->id;
//            $newProduct->save();
//
//            app(AddWarehouseProductAction::class)->execute($warehouseId, $newProduct);
//
//            $product->history = true;
//            $product->save();
        }
    }
}
