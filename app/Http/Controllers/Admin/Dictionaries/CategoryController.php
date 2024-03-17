<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Category\DestroyAction;
use App\Actions\Category\IndexAction;
use App\Actions\Category\StoreAction;
use App\Actions\Category\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Dictionaries\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(IndexAction $action, Category $category): View
    {
        $categories = $action->execute($category);

        return view('admin.dictionaries.categories.index', compact('categories'));
    }

    public function create(): View
    {
        $category = new Category();

        return view('admin.dictionaries.categories.create', compact('category'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('admin.dictionaries.categories.index'))->with('success', 'Категория добавлена');
    }

    public function edit(Category $category): View
    {
        return view('admin.dictionaries.categories.edit', compact('category'));
    }

    public function update(
        StoreRequest $request,
        UpdateAction  $action,
        Category      $category
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $category);

        return redirect(route('admin.dictionaries.categories.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        
        return redirect(route('admin.dictionaries.categories.index'))->with('success', 'Данные успешно удалены');
    }
}
