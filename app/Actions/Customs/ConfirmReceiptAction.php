<?php

namespace App\Actions\Customs;

use App\Core\Actions\CoreAction;
use App\Models\Product;
use App\Models\Receipt;

class ConfirmReceiptAction extends CoreAction
{
    public function handle(Receipt $receipt)
    {
        foreach ($receipt->products as $receiptProduct) {
            for ($i = 0; $i < (int)$receiptProduct->count; $i++) {
                $lastProduct = Product::getLastProduct();
                // Создаем товар
                Product::query()->create([
                    'dic_product_id' => $receiptProduct->dic_product_id,
                    'model_type'     => Receipt::class,
                    'model_id'       => $receipt->id,
                    'barcode'        => $lastProduct ? $lastProduct->barcode + 1 : 1,
                ]);
            }
        }

        if ($receipt->status()->canBe('approved')) {
            $receipt->status()->transitionTo('approved');
        }
    }
}
