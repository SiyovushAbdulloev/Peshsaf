<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        if (!in_array(auth()->user()->role->name, [Role::WAREHOUSE, Role::VENDOR])) {
            abort(403, 'Ошибка аутентификации. Обратитесь к администратору.');
        }

        return response()->json([
            'token' => auth()->user()->createToken('peshsaf')->plainTextToken,
            'user'  => UserResource::make(auth()->user()),
        ]);
    }

    public function destroy(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'success' => 'Successfully logged out',
        ]);
    }
}
