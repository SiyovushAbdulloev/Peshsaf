<?php

namespace App\Livewire\Admin\Dictionaries\Categories;

use App\Models\Dictionaries\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    public ?int $currentCategory = null;

    public ?Collection $products = null;

    public ?Collection $categories = null;

    public function render()
    {
        return view('livewire.admin.dictionaries.categories.index');
    }

    public function mount($categories)
    {
        $this->categories = $categories;
        if ($categories && count($categories) > 0) {
            $this->currentCategory = $categories[0]->id;
            $this->fetchProducts($this->currentCategory);
        }
    }

    public function fetchProducts($category)
    {
        $this->products = Product::where('category_id', $category)->get();
        $this->currentCategory = $category;
    }
}
