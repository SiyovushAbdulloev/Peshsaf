<?php

use App\Http\Controllers\Admin\Dictionaries\CountryController;
use App\Http\Controllers\Admin\Dictionaries\MeasurementUnitController;
use App\Http\Controllers\Admin\Dictionaries\PositionController;
use App\Http\Controllers\Admin\Dictionaries\SubstanceController;
use App\Http\Controllers\Admin\Dictionaries\SupplierController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {
    Route::prefix('dictionaries')
        ->name('dictionaries.')
        ->group(function () {
            Route::resource('measurement-units', MeasurementUnitController::class)->parameters([
                'measurement-units' => 'unit'
            ]);
            Route::resource('/countries', CountryController::class);
            Route::resource('/suppliers', SupplierController::class);
            Route::resource('/positions', PositionController::class);
            Route::resource('/substances', SubstanceController::class);
        });
    Route::resource('/users', UserController::class);
    Route::delete('/files/{file}', [FileController::class, 'delete']);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('outlets', OutletController::class);
});
