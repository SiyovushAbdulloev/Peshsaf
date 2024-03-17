<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\ActiveIngredient\IndexAction;
use App\Actions\ActiveIngredient\StoreAction;
use App\Actions\ActiveIngredient\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActiveIngredient\StoreRequest;
use App\Models\Dictionaries\ActiveIngredient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ActiveIngredientController extends Controller
{
    public function index(IndexAction $action): View
    {
        $activeIngredients = $action->execute();

        return view('admin.dictionaries.active-ingredients.index', compact('activeIngredients'));
    }

    public function create(): View
    {
        $activeIngredient = new ActiveIngredient();

        return view('admin.dictionaries.active-ingredients.create', compact('activeIngredient'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('admin.dictionaries.active-ingredients.index'))->with('success', 'Действующее вещество добавлено');
    }

    public function edit(ActiveIngredient $activeIngredient): View
    {
        return view('admin.dictionaries.active-ingredients.edit', compact('activeIngredient'));
    }

    public function update(
        StoreRequest $request,
        UpdateAction $action,
        ActiveIngredient $activeIngredient
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $activeIngredient);

        return redirect(route('admin.dictionaries.active-ingredients.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(ActiveIngredient $activeIngredient): RedirectResponse
    {
        try {
            $activeIngredient->delete();

            return redirect(route('admin.dictionaries.active-ingredients.index'))->with('success', 'Данные успешно удалены');
        } catch (Throwable $e) {
            logger($e->getMessage());
        }

        return back()->with('error', 'Невозможно удалить запись');
    }
}
