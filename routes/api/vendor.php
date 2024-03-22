<?php

use App\Http\Controllers\Api\Vendor\SaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:vendor')
    ->prefix('/vendor')
    ->group(function () {
        Route::get('/sales', [SaleController::class, 'index']);
        Route::get('/sales/clients', [SaleController::class, 'clients']);
        Route::get('/sales/create/products', [SaleController::class, 'products']);
        Route::post('/sales/create', [SaleController::class, 'store']);
    });
