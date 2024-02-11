<?php

use App\Http\Controllers\Admin\Dictionaries\CountryController;
use App\Http\Controllers\Admin\Dictionaries\MeasurementUnitController;
use App\Http\Controllers\Admin\Dictionaries\ProviderController;
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
            Route::delete('/providers/{provider}/file', [ProviderController::class, 'destroyFile']);
        });
});
