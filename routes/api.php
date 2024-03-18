<?php

use App\Http\Controllers\Api\MovementController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\WarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::middleware('role:warehouse|vendor')
            ->group(function () {
                Route::get('/sales', [SaleController::class, 'index']);
                Route::get('/sales/{client}', [SaleController::class, 'clients']);
                Route::get('/sales/create/products', [SaleController::class, 'products']);
                Route::get('/sales/create/{client?}', [SaleController::class, 'create']);
                Route::post('/sales', [SaleController::class, 'store']);

                Route::get('/warehouses', WarehouseController::class);
                Route::get('/outlets', OutletController::class);

                Route::get('/movements', [MovementController::class, 'index']);
                Route::get('/movements/create', [MovementController::class, 'create']);
                Route::get('/movements/create/products', [MovementController::class, 'products']);
                Route::post('/movements', [MovementController::class, 'store']);
            });
    });

require_once __DIR__ . '/api/auth.php';
