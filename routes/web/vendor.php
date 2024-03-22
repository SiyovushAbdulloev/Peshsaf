<?php

use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ReceiptController;
use App\Http\Controllers\Vendor\ReturnVendorController;
use App\Http\Controllers\Vendor\SaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:vendor')
    ->name('vendor.')
    ->group(function () {
        Route::resource('receipts', ReceiptController::class)->only('index', 'show');
        Route::get('receipts/{receipt}/approving',
            [ReceiptController::class, 'approving'])->name('receipts.approving');
        Route::post('receipts/{receipt}/approve', [ReceiptController::class, 'approve'])->name('receipts.approve');
        
        Route::get('products', [ProductController::class, 'index'])->name('products.index');

        Route::get('/sales/clients', [SaleController::class, 'clients'])->name('sales.clients');
        Route::get('/sales/create/{client?}', [SaleController::class, 'create'])->name('sales.create');
        Route::resource('sales', SaleController::class)->except('create');

        Route::resource('/returns-vendor', ReturnVendorController::class)->parameters([
            'returns-vendor-vendor' => 'return'
        ]);
        Route::resource('/returns-warehouse', ReturnVendorController::class)->parameters([
            'returns-vendor-warehouse' => 'return'
        ]);
});
