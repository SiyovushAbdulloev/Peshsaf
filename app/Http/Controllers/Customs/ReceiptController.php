<?php

namespace App\Http\Controllers\Customs;

use App\Actions\Customs\GetReceiptsAction;
use App\Http\Controllers\Controller;
use App\Models\Receipt;
use Illuminate\View\View;

class ReceiptController extends Controller
{
    public function index(GetReceiptsAction $action): View
    {
        $receipts = $action->execute();

        return view('customs.receipts.index', compact('receipts'));
    }

    public function show(Receipt $receipt): View
    {
        $receipt = $receipt->load('products.product.measure');
        return view('customs.receipts.show', compact('receipt'));
    }
}
