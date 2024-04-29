<?php

namespace App\Http\Controllers;

use App\Actions\Analitics\GetVendorViewAction;
use App\Actions\Analitics\GetWarehouseViewAction;
use App\Models\Role;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(
        GetWarehouseViewAction $getWarehouseViewAction,
        GetVendorViewAction $getVendorViewAction
    ): View {
        return match (auth()->user()->role->name) {
            Role::WAREHOUSE => $getWarehouseViewAction->execute(),
            Role::VENDOR => $getVendorViewAction->execute(),
        };
    }
}
