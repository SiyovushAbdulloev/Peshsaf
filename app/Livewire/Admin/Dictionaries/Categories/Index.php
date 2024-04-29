<?php

namespace App\Livewire\Admin\Dictionaries\Categories;

use App\Models\Dictionaries\Category;
use App\Models\Dictionaries\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    public ?Category $currentCategory = null;

    public ?Collection $products = null;

    public ?Collection $categories = null;

    public function render()
    {
        return view('livewire.admin.dictionaries.categories.index');
    }

    public function mount()
    {
        if (request()->get('category')) {
            $this->currentCategory = Category::with('products.measure')->find(request()->get('category'));
        } else {
            $this->currentCategory = Category::with('products.measure')->first();
        }
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();

        session()->flash('success', 'Категория успешно удалена');

        $this->redirect(route('admin.dictionaries.categories.index'));
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        session()->flash('success', 'Продукт успешно удален');

        $this->redirect(route('admin.dictionaries.categories.index', ['category' => $this->currentCategory->id]));
    }
}
