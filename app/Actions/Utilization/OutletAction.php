<?php

namespace App\Actions\Utilization;

use App\Core\Actions\CoreAction;
use App\Models\Outlet;
use App\Models\Utilization;

class OutletAction extends CoreAction
{
    public function handle(Utilization $utilization): void
    {
        foreach ($utilization->products as $utilizationProduct) {
            $product = $utilizationProduct->product->lastActive;
            if (!$product->status()->canBe('used')) {
                continue;
            }

            $newProduct             = $product->replicate();
            $newProduct->model_type = Outlet::class;
            $newProduct->model_id   = auth()->user()->outlet_id;
            $newProduct->save();

            $newProduct->status()->transitionTo('used');

            $product->history = true;
            $product->save();
        }
    }
}
