<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\ActiveIngredient\IndexAction as ActiveIngredientIndexAction;
use App\Actions\Country\IndexAction as CountryIndexAction;
use App\Actions\Measure\IndexAction as MeasureIndexAction;
use App\Actions\Product\DestroyAction;
use App\Actions\Product\StoreAction;
use App\Actions\Product\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Dictionaries\Category;
use App\Models\Dictionaries\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ProductController extends Controller
{
    public function create(
        CountryIndexAction $countryIndexAction,
        ActiveIngredientIndexAction $activeIngredientIndexAction,
        MeasureIndexAction $measureIndexAction,
        Category $category
    ): View {
        $product = new Product();

        return view('admin.dictionaries.categories.products.create', [
            'countries'         => $countryIndexAction->execute(),
            'activeIngredients' => $activeIngredientIndexAction->execute(),
            'measures'          => $measureIndexAction->execute(),
            'list'              => config('project.list'),
            'category'          => $category,
            'product'           => $product,
        ]);
    }

    public function store(
        StoreRequest $request,
        StoreAction $action,
        Category $category
    ): RedirectResponse {
        $action->execute($request->getParams(), $category);

        return redirect(route('admin.dictionaries.categories.index', compact('category')))->with('success',
            'Продукт добавлен');
    }

    public function edit(
        CountryIndexAction $countryIndexAction,
        ActiveIngredientIndexAction $activeIngredientIndexAction,
        MeasureIndexAction $measureIndexAction,
        Category $category,
        Product $product
    ): View {
        return view('admin.dictionaries.categories.products.edit', [
            'countries'         => $countryIndexAction->execute(),
            'activeIngredients' => $activeIngredientIndexAction->execute(),
            'measures'          => $measureIndexAction->execute(),
            'list'              => config('project.list'),
            'category'          => $category,
            'product'           => $product,
        ]);
    }

    public function update(
        UpdateRequest $request,
        UpdateAction $action,
        Category $category,
        Product $product
    ): RedirectResponse {
        $action->execute($request->getParams(), $product);

        return redirect(route('admin.dictionaries.categories.products.edit', compact('category', 'product')))->with('success',
            'Данные успешно изменены');
    }

    public function destroy(DestroyAction $action, Category $category, Product $product): RedirectResponse
    {
        try {
            $action->execute($product);

            return redirect(route('admin.dictionaries.categories.index'))->with('success', 'Данные успешно удалены');
        } catch (Throwable $e) {
            logger($e->getMessage());
        }

        return back()->with('error', 'Невозможно удалить запись');
    }
}
