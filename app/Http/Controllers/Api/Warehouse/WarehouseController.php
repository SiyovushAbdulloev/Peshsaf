<?php

namespace App\Http\Controllers\Api\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'warehouses' => WarehouseResource::collection(Warehouse::get())
        ]);
    }
}
