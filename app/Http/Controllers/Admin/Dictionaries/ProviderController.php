<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Country\IndexAction as CountryIndexAction;
use App\Actions\Provider\DestroyAction;
use App\Actions\Provider\IndexAction;
use App\Actions\Provider\StoreAction;
use App\Actions\Provider\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Provider\StoreRequest;
use App\Http\Requests\Provider\UpdateRequest;
use App\Http\Resources\CountryResource;
use App\Models\Provider;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ProviderController extends Controller
{
    public function index(IndexAction $action): View
    {
        $providers = $action->execute();

        return view('admin.dictionaries.providers.index', compact('providers'));
    }

    public function create(CountryIndexAction $action): View
    {
        $countries = $action->execute();
        $provider = new Provider();

        return view('admin.dictionaries.providers.create', [
            'countries' => CountryResource::collection($countries),
            'provider' => $provider,
            'page' => 'create'
        ]);
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('admin.dictionaries.providers.index'))->with('success', 'Поставщик добавлен');
    }

    public function edit(CountryIndexAction $action, Provider $provider): View
    {
        $countries = $action->execute();

        return view('admin.dictionaries.providers.edit', compact('provider', 'countries'));
    }

    public function update(
        UpdateRequest $request,
        UpdateAction  $action,
        Provider      $provider
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $provider);

        return redirect(route('admin.dictionaries.providers.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(DestroyAction $action, Provider $provider): RedirectResponse
    {
        try {
            $action->execute($provider);

            return redirect(route('admin.dictionaries.providers.index'))->with('success', 'Данные успешно удалены');
        } catch (Throwable $e) {
            logger($e->getMessage());
        }

        return back()->with('error', 'Невозможно удалить запись');
    }
}
