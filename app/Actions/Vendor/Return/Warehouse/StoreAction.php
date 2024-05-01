<?php

namespace App\Actions\Vendor\Return\Warehouse;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Return\Warehouse\StoreRequestParams;
use App\Models\OutletProduct;
use App\Models\Refund;
use App\Models\Warehouse;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): void
    {
        // Возврат создаем только на склад
        if ($params->distribute) {
            $warehouses = OutletProduct::query()
                ->where('model_type', Warehouse::class)
                ->whereIn('product_id', $params->products)
                ->get()
                ->groupBy('model_id');

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
        }
    }
}
