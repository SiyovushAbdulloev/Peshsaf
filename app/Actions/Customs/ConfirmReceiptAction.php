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
                $lastProduct  = Product::getLastProduct();
                $serialNumber = $lastProduct ? $lastProduct->serial_number + 1 : 1;

                // Создаем товар
                Product::query()->create([
                    'dic_product_id' => $receiptProduct->dic_product_id,
                    'model_type'     => Receipt::class,
                    'model_id'       => $receipt->id,
                    'serial_number'  => $serialNumber,
                    'barcode'        => join([
                        $receiptProduct->product->country->code,
                        $receipt->supplier->code,
                        $receiptProduct->product->category->code,
                        str_pad($serialNumber, 7, '0', STR_PAD_LEFT),
                    ]),
                ]);
            }
        }

        if ($receipt->status()->canBe('approved')) {
            $receipt->status()->transitionTo('approved');
        }
    }
}
