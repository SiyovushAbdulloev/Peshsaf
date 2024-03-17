<?php

use App\Http\Controllers\Vendor\SaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('role:vendor')
    ->name('vendor.')
    ->group(function () {
        Route::get('/sales/clients', [SaleController::class, 'clients'])->name('sales.clients');
        Route::get('/sales/create/{client?}', [SaleController::class, 'create'])->name('sales.create');
        Route::resource('sales', SaleController::class)->except('create');
});
