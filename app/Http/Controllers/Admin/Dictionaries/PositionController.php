<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Position\IndexAction;
use App\Actions\Position\StoreAction;
use App\Actions\Position\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Position\StoreRequest;
use App\Models\Position;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class PositionController extends Controller
{
    public function index(IndexAction $action): View
    {
        $positions = $action->execute();

        return view('admin.dictionaries.positions.index', compact('positions'));
    }

    public function create(): View
    {
        $position = new Position();

        return view('admin.dictionaries.positions.create', compact('position'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('dictionaries.position.index'))->with('success', 'Позиция добавлена');
    }

    public function edit(Position $position): View
    {
        return view('admin.dictionaries.positions.edit', compact('position'));
    }

    public function update(
        StoreRequest $request,
        UpdateAction $action,
        Position $position
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $position);

        return redirect(route('dictionaries.positions.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(Position $position): RedirectResponse
    {
        try {
            $position->delete();

            return redirect(route('dictionaries.positions.index'))->with('success', 'Данные успешно удалены');
        } catch (Throwable $e) {
            logger($e->getMessage());
        }

        return back()->with('error', 'Невозможно удалить запись');
    }
}
