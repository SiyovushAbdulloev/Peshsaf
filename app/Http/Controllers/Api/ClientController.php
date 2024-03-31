<?php

namespace App\Http\Controllers\Api;

use App\Actions\Warehouse\Sale\GetClientsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __invoke(Request $request, GetClientsAction $action): JsonResponse
    {
        $clients = $action->execute($request->get('q'));

        if (!$clients) {
            return response()->json(['data' => []]);
        }

        return response()->json(ClientResource::collection($clients));
    }
}
