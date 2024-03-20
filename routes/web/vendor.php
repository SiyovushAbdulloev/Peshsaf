<?php

use App\Http\Controllers\Vendor\ReceiptController;
use App\Http\Controllers\Vendor\SaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:vendor')
    ->name('vendor.')
    ->group(function () {
        Route::resource('receipts', ReceiptController::class);
        Route::post('receipts/{receipt}/send', [ReceiptController::class, 'send'])->name('receipts.send');
        Route::delete('receipts/{receipt}/products/{product}', [ReceiptProductController::class, 'destroy'])->name('receipts.products.destroy');

        Route::get('/sales/clients', [SaleController::class, 'clients'])->name('sales.clients');
        Route::get('/sales/create/{client?}', [SaleController::class, 'create'])->name('sales.create');
        Route::resource('sales', SaleController::class)->except('create');
});
