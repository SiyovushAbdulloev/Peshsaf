<?php

namespace App\Actions\Vendor\Return\Client;

use App\Actions\Vendor\AddOutletProductAction;
use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\Refund;
use App\StateMachines\StatusReturn;

class FinishAction extends CoreAction
{
    public function handle(Refund $return): Refund
    {
        foreach ($return->products as $returnProduct) {
            $product                = Product::find($returnProduct->product_id);

            $newProduct             = $product->replicate();
            $newProduct->model_type = Refund::class;
            $newProduct->model_id   = $return->id;
            $newProduct->save();

            $newProduct->status()->transitionTo('new');

            // Приходуем в остатки торговой точки
            app(AddOutletProductAction::class)->execute($newProduct);

            $product->history = true;
            $product->save();
        }

        $return->status()->transitionTo(StatusReturn::FINISHED);

        return $return;
    }
}
