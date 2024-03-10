<?php

use App\Http\Controllers\Admin\Dictionaries\ActiveIngredientController;
use App\Http\Controllers\Admin\Dictionaries\CategoryController;
use App\Http\Controllers\Admin\Dictionaries\CountryController;
use App\Http\Controllers\Admin\Dictionaries\MeasureController;
use App\Http\Controllers\Admin\Dictionaries\PositionController;
use App\Http\Controllers\Admin\Dictionaries\ProductController;
use App\Http\Controllers\Admin\Dictionaries\SupplierController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {
    Route::prefix('dictionaries')
        ->name('dictionaries.')
        ->group(function () {
            Route::resource('measurement-units', MeasureController::class)->parameters([
                'measurement-units' => 'unit'
            ]);
            Route::resource('/countries', CountryController::class);
            Route::resource('/suppliers', SupplierController::class);
            Route::resource('/positions', PositionController::class);
            Route::resource('/active-ingredients', ActiveIngredientController::class)->parameters([
                'active-ingredients' => 'activeIngredient'
            ]);
            Route::prefix('/categories')
                ->name('categories.')
                ->group(function () {
                    Route::get('/', [CategoryController::class, 'index'])->name('index');
                    Route::get('/create', [CategoryController::class, 'create'])->name('create');
                    Route::post('/', [CategoryController::class, 'store'])->name('store');
                    Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
                    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
                    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');

                    Route::prefix('/{category}/products')
                        ->name('products.')
                        ->group(function () {
                            Route::get('/create', [ProductController::class, 'create'])->name('create');
                            Route::post('/', [ProductController::class, 'store'])->name('store');
                            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit');
                            Route::put('/{product}', [ProductController::class, 'update'])->name('update');
                            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy');
                        });
                });
        });
    Route::resource('/users', UserController::class);
    Route::delete('/files/{file}', [FileController::class, 'delete']);
    Route::resource('warehouses', WarehouseController::class);
    Route::resource('outlets', OutletController::class);
});
