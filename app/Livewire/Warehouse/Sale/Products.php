<?php

namespace App\Livewire\Warehouse\Sale;

use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Products extends Component
{
    public ?Collection $selectedProducts;

    public function mount()
    {
        $this->selectedProducts = Product::whereIn('id', old('products', []))->get();
    }

    #[On('confirm')]
    public function search(string $barcode)
    {
        $product = Product::firstWhere('barcode', $barcode);

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);
        }
    }

    public function deleteProduct($productId): void
    {
        $this->selectedProducts = $this->selectedProducts->filter(fn ($item) => $item->id !== $productId);
    }

    public function render()
    {
        return view('livewire.warehouse.sale.products');
    }
}
