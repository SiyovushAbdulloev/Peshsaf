<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Country\IndexAction as CountryIndexAction;
use App\Actions\Provider\IndexAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProviderController extends Controller
{
    public function index(IndexAction $action): Application|View|Factory
    {
        $providers = $action->execute();

        return view('admin.provider.index', compact('providers'));
    }

    public function create(CountryIndexAction $action): Application|View|Factory
    {
        $countries = $action->execute();

        return view('admin.provider.create', [
            'countries' => CountryResource::collection($countries)
        ]);
    }
}
