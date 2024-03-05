<?php

use App\Http\Controllers\Warehouse\ProductController;
use App\Http\Controllers\Warehouse\ReceiptController;
use Illuminate\Support\Facades\Route;

Route::name('warehouse.')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::resource('receipts', ReceiptController::class);
});
