<?php

use App\Http\Controllers\Vendor\ReceiptController;
use App\Http\Controllers\Vendor\SaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:vendor')
    ->name('vendor.')
    ->group(function () {
        Route::resource('receipts', ReceiptController::class)->only('index', 'show');
        Route::get('receipts/{receipt}/approving',
            [ReceiptController::class, 'approving'])->name('receipts.approving');
        Route::post('receipts/{receipt}/approve', [ReceiptController::class, 'approve'])->name('receipts.approve');

        Route::get('/sales/clients', [SaleController::class, 'clients'])->name('sales.clients');
        Route::get('/sales/create/{client?}', [SaleController::class, 'create'])->name('sales.create');
        Route::resource('sales', SaleController::class)->except('create');
});
