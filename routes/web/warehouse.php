<?php

use App\Http\Controllers\Warehouse\MovementController;
use App\Http\Controllers\Warehouse\ProductController;
use App\Http\Controllers\Warehouse\ReceiptController;
use App\Http\Controllers\Warehouse\ReceiptProductController;
use App\Http\Controllers\Warehouse\Reports\OutletController;
use App\Http\Controllers\Warehouse\Reports\RemainController;
use App\Http\Controllers\Warehouse\Reports\UtilizationController as UtilizationReportController;
use App\Http\Controllers\Warehouse\ReturnController;
use App\Http\Controllers\Warehouse\SaleController;
use App\Http\Controllers\Warehouse\UtilizationController;
use Illuminate\Support\Facades\Route;

Route::name('warehouse.')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::resource('receipts', ReceiptController::class);
    Route::patch('receipts/{receipt}/send', [ReceiptController::class, 'send'])->name('receipts.send');
    Route::delete('receipts/{receipt}/products/{product}',
        [ReceiptProductController::class, 'destroy'])->name('receipts.products.destroy');

    Route::get('/sales/clients', [SaleController::class, 'clients'])->name('sales.clients');
    Route::get('/sales/create/{client?}', [SaleController::class, 'create'])->name('sales.create');
    Route::resource('sales', SaleController::class)->except('create');

    // Перемещения товаров
    Route::resource('movements', MovementController::class);

    // Утилизация товаров
    Route::resource('utilizations', UtilizationController::class);

    Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
    Route::get('/returns/{return}', [ReturnController::class, 'show'])->name('returns.show');

    Route::prefix('reports')
        ->name('reports.')
        ->group(function () {
            Route::get('/remains', [RemainController::class, 'index'])->name('remains.index');
            Route::get('/utilizations', [UtilizationReportController::class, 'index'])->name('utilizations.index');
            Route::get('/outlets', [OutletController::class, 'index'])->name('outlets.index');
        });
});
