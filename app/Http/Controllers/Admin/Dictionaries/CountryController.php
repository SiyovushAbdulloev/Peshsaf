<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Country\IndexAction;
use App\Actions\Country\StoreAction;
use App\Actions\Country\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Country\StoreRequest;
use App\Models\Country;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class CountryController extends Controller
{
    public function index(IndexAction $action): View
    {
        $countries = $action->execute();

        return view('admin.dictionaries.countries.index', compact('countries'));
    }

    public function create(): View
    {
        $country = new Country();

        return view('admin.dictionaries.countries.create', compact('country'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('admin.dictionaries.countries.index'))->with('success', 'Страна добавлена');
    }

    public function edit(Country $country): View
    {
        return view('admin.dictionaries.countries.edit', compact('country'));
    }

    public function update(
        StoreRequest $request,
        UpdateAction $action,
        Country $country
    ): RedirectResponse {
        $action->execute($request->getParams(), $country);

        return redirect(route('admin.dictionaries.countries.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(Country $country): RedirectResponse
    {
        try {
            $country->delete();

            return redirect(route('admin.dictionaries.countries.index'))->with('success', 'Данные успешно удалены');
        } catch (Throwable $e) {
            logger($e->getMessage());
        }

        return back()->with('error', 'Невозможно удалить запись');
    }
}
