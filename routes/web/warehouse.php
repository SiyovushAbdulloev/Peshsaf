<?php

use App\Http\Controllers\Warehouse\ProductController;
use App\Http\Controllers\Warehouse\ReceiptController;
use App\Http\Controllers\Warehouse\ReceiptProductController;
use App\Http\Controllers\Warehouse\SaleController;
use Illuminate\Support\Facades\Route;

Route::name('warehouse.')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::resource('receipts', ReceiptController::class);
    Route::post('receipts/{receipt}/send', [ReceiptController::class, 'send'])->name('receipts.send');
    Route::delete('receipts/{receipt}/products/{product}', [ReceiptProductController::class, 'destroy'])->name('receipts.products.destroy');

    Route::resource('sales', SaleController::class);
});
