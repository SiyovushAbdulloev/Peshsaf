<?php

use App\Http\Controllers\Customs\ReceiptController;
use Illuminate\Support\Facades\Route;

Route::name('customs.')->group(function () {
    Route::resource('receipts', ReceiptController::class);
    Route::get('receipts/{receipt}',
        [ReceiptController::class, 'show'])->name('receipts.show');
});
