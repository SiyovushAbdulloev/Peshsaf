<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Country\IndexAction;
use App\Actions\Country\StoreAction;
use App\Actions\Country\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CountryController extends Controller
{
    public function index(IndexAction $action): Application|View|Factory
    {
        $countries = $action->execute();

        return view('admin.country.index', compact('countries'));
    }

    public function create(): Application|View|Factory
    {
        return view('admin.country.create');
    }

    public function store(StoreRequest $request, StoreAction $action): CountryResource
    {
        $country = $action->execute($request->getParams());

        return new CountryResource($country);
    }

    public function edit(Country $country): Application|View|Factory
    {
        return view('admin.country.edit', compact('country'));
    }

    public function update(
        StoreRequest $request,
        UpdateAction $action,
        Country $country
    ): CountryResource
    {
        $country = $action->execute($request->getParams(), $country);

        return new CountryResource($country);
    }
}
