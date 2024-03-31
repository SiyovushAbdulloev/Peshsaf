<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OutletResource;
use App\Models\Outlet;
use Symfony\Component\HttpFoundation\JsonResponse;

class OutletController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(OutletResource::collection(Outlet::get()));
    }
}
