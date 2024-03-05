<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Position\IndexAction as PositionIndexAction;
use App\Actions\User\DestroyAction;
use App\Actions\User\IndexAction;
use App\Actions\User\StoreAction;
use App\Actions\User\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class UserController extends Controller
{
    public function index(IndexAction $action): View
    {
        $users = $action->execute();

        return view('admin.users.index', compact('users'));
    }

    public function create(PositionIndexAction $action): View
    {
        $positions = $action->execute();
        $user = new User();

        return view('admin.users.create', compact('user', 'positions'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('admin.users.index'))->with('success', 'Пользователь добавлен');
    }

    public function edit(PositionIndexAction $action, User $user): View
    {
        $positions = $action->execute();

        return view('admin.users.edit', compact('user', 'positions'));
    }

    public function update(
        UpdateRequest $request,
        UpdateAction $action,
        User $user
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $user);

        return redirect(route('admin.users.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(DestroyAction $action, User $user): RedirectResponse
    {
        try {
            $action->execute($user);

            return redirect(route('admin.users.index'))->with('success', 'Данные успешно удалены');
        } catch (Throwable $e) {
            logger($e->getMessage());
        }

        return back()->with('error', 'Невозможно удалить запись');
    }
}
