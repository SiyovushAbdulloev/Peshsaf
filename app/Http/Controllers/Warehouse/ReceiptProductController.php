<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\ReceiptProduct;

class ReceiptProductController extends Controller
{
    public function destroy(Receipt $receipt, ReceiptProduct $product): bool
    {
        return $product->delete();
    }
}
