<?php

use App\Http\Controllers\Admin\Dictionaries\CountryController;
use App\Http\Controllers\Admin\Dictionaries\MeasurementUnitController;
use App\Http\Controllers\Admin\Dictionaries\PositionController;
use App\Http\Controllers\Admin\Dictionaries\ProviderController;
use App\Http\Controllers\Admin\Dictionaries\SubstanceController;
use App\Http\Controllers\Admin\UserController;
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
            Route::resource('/providers', ProviderController::class);
            Route::resource('/positions', PositionController::class);
            Route::resource('/substances', SubstanceController::class);
        });
    Route::resource('/users', UserController::class);
    Route::delete('/files/{file}', [FileController::class, 'delete']);
});
