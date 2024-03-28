<?php

use App\Http\Controllers\Api\Warehouse\MovementController;
use App\Http\Controllers\Api\Warehouse\ReturnController;
use App\Http\Controllers\Api\Warehouse\SaleController;
use App\Http\Controllers\Api\Warehouse\UtilizationController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:warehouse')
    ->prefix('/warehouse')
    ->group(function () {
        Route::get('/sales', [SaleController::class, 'index']);
        Route::get('/sales/{sale}', [SaleController::class, 'show']);
        Route::get('/sales/clients', [SaleController::class, 'clients']);
        Route::get('/sales/create/products', [SaleController::class, 'products']);
        Route::post('/sales/create', [SaleController::class, 'store']);

        Route::get('/movements', [MovementController::class, 'index']);
        Route::get('/movements/outlets', [MovementController::class, 'outlets']);
        Route::get('/movements/{movement}', [MovementController::class, 'show']);
        Route::get('/movements/create/products', [MovementController::class, 'products']);
        Route::post('/movements/create', [MovementController::class, 'store']);
        Route::patch('/movements/{movement}/edit', [MovementController::class, 'update']);
        Route::patch('/movements/{movement}/edit', [MovementController::class, 'update']);
        Route::post('/movements/{movement}/send', [MovementController::class, 'send']);
        Route::post('/movements/{movement}/products/add', [MovementController::class, 'addProduct']);
        Route::delete('/movements/{movement}/products/{movementProduct}', [MovementController::class, 'removeProduct']);

        Route::get('/utilizations', [UtilizationController::class, 'index']);
        Route::post('/utilizations/create', [UtilizationController::class, 'store']);
        Route::get('/utilizations/{utilization}', [UtilizationController::class, 'show']);
        Route::patch('/utilizations/{utilization}', [UtilizationController::class, 'update']);
        Route::delete('/utilizations/{utilization}', [UtilizationController::class, 'destroy']);
        Route::patch('/utilizations/{utilization}/finish', [UtilizationController::class, 'finish']);

        Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
        Route::get('/returns/{return}', [ReturnController::class, 'show'])->name('returns.show');
        Route::patch('/returns/{return}/approve', [ReturnController::class, 'approve'])->name('returns.approve');
    });
