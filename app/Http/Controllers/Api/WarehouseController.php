<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;
use Symfony\Component\HttpFoundation\JsonResponse;

class WarehouseController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(WarehouseResource::collection(Warehouse::get()));
    }
}
