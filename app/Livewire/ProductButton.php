<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductButton extends Component
{
    public Product $record;

    public function render()
    {
        return view('livewire.product-button');
    }

    public function mount($product)
    {
        $this->record = Product::find($product);
    }

    public function getProduct()
    {
        $this->dispatch('show-modal', $this->record);
    }
}
