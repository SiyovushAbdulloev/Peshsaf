<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Role;

class AuthenticatedSessionController extends Controller
{
    public function store(LoginRequest $request): string
    {
        $request->authenticate();

        if (!in_array(auth()->user()->role->name, [Role::WAREHOUSE, Role::VENDOR])) {
            abort(403, 'Админ не должен войти через мобильное приложение');
        }

        return auth()->user()->createToken('peshsaf')->plainTextToken;
    }

    public function destroy(): bool
    {
        auth()->user()->tokens()->delete();

        return true;
    }
}
