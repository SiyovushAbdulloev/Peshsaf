<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Substance\IndexAction;
use App\Actions\Substance\StoreAction;
use App\Actions\Substance\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Substance\StoreRequest;
use App\Models\Substance;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class SubstanceController extends Controller
{
    public function index(IndexAction $action): View
    {
        $substances = $action->execute();

        return view('admin.dictionaries.substances.index', compact('substances'));
    }

    public function create(): View
    {
        $substance = new Substance();

        return view('admin.dictionaries.substances.create', compact('substance'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('dictionaries.substances.index'))->with('success', 'Действующее вещество добавлено');
    }

    public function edit(Substance $substance): View
    {
        return view('admin.dictionaries.substances.edit', compact('substance'));
    }

    public function update(
        StoreRequest $request,
        UpdateAction $action,
        Substance $substance
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $substance);

        return redirect(route('dictionaries.substances.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(Substance $substance): RedirectResponse
    {
        try {
            $substance->delete();

            return redirect(route('dictionaries.substances.index'))->with('success', 'Данные успешно удалены');
        } catch (Throwable $e) {
            logger($e->getMessage());
        }

        return back()->with('error', 'Невозможно удалить запись');
    }
}
