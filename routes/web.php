<?php

use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\Dictionaries\MeasurementUnitController;
use App\Http\Controllers\Admin\Dictionaries\PositionController;
use App\Http\Controllers\Admin\MeasurementUnitController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;

>>>>>>> 73f312e (Added index method of PositionController (wip))

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::prefix('/admin')
        ->group(__DIR__ . '/web/admin.php');
    Route::prefix('/warehouse')
        ->group(__DIR__ . '/web/warehouse.php');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
