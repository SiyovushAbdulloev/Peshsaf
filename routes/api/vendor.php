<?php

use App\Http\Controllers\Api\Vendor\ProductController;
use App\Http\Controllers\Api\Vendor\ReceiptController;
use App\Http\Controllers\Api\Vendor\Returns\ClientController;
use App\Http\Controllers\Api\Vendor\Returns\WarehouseController;
use App\Http\Controllers\Api\Vendor\SaleController;
use App\Http\Controllers\Api\Vendor\UtilizationController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:vendor')
    ->prefix('/vendor')
    ->group(function () {
        Route::get('/sales', [SaleController::class, 'index']);
        Route::get('/sales/{sale}', [SaleController::class, 'show']);
        Route::post('/sales/create', [SaleController::class, 'store']);

        Route::get('/receipts', [ReceiptController::class, 'index']);
        Route::get('/receipts/{receipt}', [ReceiptController::class, 'show']);
        Route::patch('/receipts/{receipt}/approve', [ReceiptController::class, 'approve']);

        Route::get('/utilizations', [UtilizationController::class, 'index']);
        Route::post('/utilizations/create', [UtilizationController::class, 'store']);
        Route::get('/utilizations/{utilization}', [UtilizationController::class, 'show']);
        Route::patch('/utilizations/{utilization}', [UtilizationController::class, 'update']);
        Route::delete('/utilizations/{utilization}', [UtilizationController::class, 'destroy']);
        Route::patch('/utilizations/{utilization}/finish', [UtilizationController::class, 'finish']);
        Route::post('/utilizations/{utilization}/products/add', [UtilizationController::class, 'addProduct']);
        Route::delete('/utilizations/{utilization}/products/{utilizationProduct}',
            [UtilizationController::class, 'removeProduct']);

        Route::prefix('/returns')->name('returns.')->group(function () {
            Route::apiResource('warehouse', WarehouseController::class)->parameters([
                'warehouse' => 'return',
            ]);
            Route::patch('/warehouse/{return}/send', [WarehouseController::class, 'send'])->name('warehouse.send');
            Route::post('/warehouse/{return}/products/add', [WarehouseController::class, 'addProduct']);
            Route::delete('/warehouse/{return}/products/{returnProduct}',
                [WarehouseController::class, 'removeProduct']);

            Route::apiResource('clients', ClientController::class)->parameters([
                'clients' => 'return',
            ]);
            Route::post('/clients/{return}/products/add', [ClientController::class, 'addProduct']);
            Route::delete('/clients/{return}/products/{returnProduct}',
                [WarehouseController::class, 'removeProduct']);
        });

        Route::prefix('/products')->group(function () {
            Route::get('/new', [ProductController::class, 'new']);
            Route::get('/sold', [ProductController::class, 'sold']);
        });
    });
