<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        if (!in_array(auth()->user()->role->name, [Role::WAREHOUSE, Role::VENDOR])) {
            abort(403, 'Админ не должен войти через мобильное приложение');
        }

        return response()->json([
            'token' => auth()->user()->createToken('peshsaf')->plainTextToken
        ]);
    }

    public function destroy(): bool
    {
        auth()->user()->tokens()->delete();

        return true;
    }
}
