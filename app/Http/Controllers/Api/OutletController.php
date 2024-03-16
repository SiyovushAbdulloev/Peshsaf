<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OutletResource;
use App\Models\Outlet;

class OutletController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'outlets' => OutletResource::collection(Outlet::get())
        ]);
    }
}
