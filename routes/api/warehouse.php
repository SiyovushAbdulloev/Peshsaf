<?php

use App\Http\Controllers\Api\Warehouse\MovementController;
use App\Http\Controllers\Api\Warehouse\SaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:warehouse')
    ->prefix('/warehouse')
    ->group(function () {
        Route::get('/sales', [SaleController::class, 'index']);
        Route::get('/sales/clients', [SaleController::class, 'clients']);
        Route::get('/sales/create/products', [SaleController::class, 'products']);
        Route::post('/sales/create', [SaleController::class, 'store']);

        Route::get('/movements', [MovementController::class, 'index']);
        Route::get('/movements/create', [MovementController::class, 'create']);
        Route::get('/movements/create/products', [MovementController::class, 'products']);
        Route::post('/movements', [MovementController::class, 'store']);
    });
