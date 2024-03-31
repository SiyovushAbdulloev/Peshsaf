<?php

use App\Http\Controllers\Api\Vendor\ReceiptController;
use App\Http\Controllers\Api\Vendor\SaleController;
use App\Http\Controllers\Api\Vendor\UtilizationController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:vendor')
    ->prefix('/vendor')
    ->group(function () {
        Route::get('/sales', [SaleController::class, 'index']);
        Route::get('/sales/clients', [SaleController::class, 'clients']);
        Route::get('/sales/create/products', [SaleController::class, 'products']);
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
        Route::delete('/utilizations/{utilization}/products/{utilizationProduct}', [UtilizationController::class, 'removeProduct']);
    });
