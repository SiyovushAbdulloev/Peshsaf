<?php

namespace App\Actions\Utilization;

use App\Core\Actions\CoreAction;
use App\Models\Utilization;
use App\Models\Warehouse;

class WarehouseAction extends CoreAction
{
    public function handle(Utilization $utilization): void
    {
        foreach ($utilization->products as $utilizationProduct) {
            $product = $utilizationProduct->product->lastActive;
            if (!$product->status()->canBe('utilized')) {
                continue;
            }

            $newProduct             = $product->replicate();
            $newProduct->model_type = Warehouse::class;
            $newProduct->model_id   = auth()->user()->warehouse_id;
            $newProduct->save();

            $newProduct->status()->transitionTo('utilized');

            $product->history = true;
            $product->save();
        }
    }
}
