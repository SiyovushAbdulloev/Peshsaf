<?php

use App\Http\Controllers\Api\Warehouse\OutletController;
use App\Http\Controllers\Api\Warehouse\WarehouseController;
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
                Route::get('/warehouses', WarehouseController::class);
                Route::get('/outlets', OutletController::class);
            });

        require_once __DIR__ . '/api/warehouse.php';
        require_once __DIR__ . '/api/vendor.php';
    });

require_once __DIR__ . '/api/auth.php';
