<?php

use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ReceiptController;
use App\Http\Controllers\Vendor\Returns\ClientController;
use App\Http\Controllers\Vendor\Returns\WarehouseController;
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

        Route::prefix('/returns')->name('returns.')->group(function () {
            Route::resource('/warehouse', WarehouseController::class)->parameters([
                'warehouse' => 'return',
            ]);
            Route::patch('/warehouse/{return}/send', [WarehouseController::class, 'send'])->name('warehouse.send');

            Route::resource('/clients', ClientController::class)->parameters([
                'clients' => 'return',
            ]);
        });
    });
