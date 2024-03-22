<?php

use App\Http\Controllers\Customs\ReceiptController;
use Illuminate\Support\Facades\Route;

Route::name('customs.')->group(function () {
    Route::resource('receipts', ReceiptController::class);
    Route::get('receipts/{receipt}/confirmation',
        [ReceiptController::class, 'confirmation'])->name('receipts.confirmation');
    Route::post('receipts/{receipt}/confirm', [ReceiptController::class, 'confirm'])->name('receipts.confirm');
});
