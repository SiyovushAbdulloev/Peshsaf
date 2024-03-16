<?php

namespace App\Livewire\Warehouse\Movement;

use App\Models\Movement;
use App\Models\Product;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Products extends Component
{
    public ?Movement $movement = null;

    public ?Collection $selectedProducts;

    public function mount(Movement $movement)
    {
        $this->movement = $movement;

        $this->selectedProducts = Product::whereIn('id', old('products', $movement->products->pluck('product_id')))->get();
    }

    #[On('search')]
    public function search(string $barcode)
    {
        $product = Product::query()->byStatus('new')->firstWhere('barcode', $barcode);

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);

            if ($this->movement->exists) {
                $this->movement->products()->firstOrCreate([
                    'product_id' => $product->id,
                ]);
            }
        }
    }

    public function deleteProduct($productId): void
    {
        if ($this->movement->exists) {
            $this->movement->products()->where('product_id', $productId)->delete();
        }
        $this->selectedProducts = $this->selectedProducts->filter(fn($item) => $item->id !== $productId);
    }

    public function render()
    {
        return view('livewire.warehouse.movement.products');
    }
}
