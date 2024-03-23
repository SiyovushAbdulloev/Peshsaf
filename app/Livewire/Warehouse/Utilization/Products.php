<?php

namespace App\Livewire\Warehouse\Utilization;

use App\Models\Product;
use App\Models\Utilization;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Products extends Component
{
    public ?Utilization $utilization = null;

    public ?Collection $selectedProducts;

    public function mount(Utilization $utilization): void
    {
        $this->utilization = $utilization;

        $this->selectedProducts = Product::with('product.measure')
            ->whereIn('id', old('products', $utilization->products->pluck('product_id')))
            ->get();
    }

    #[On('search')]
    public function search(string $barcode): void
    {
        $product = Product::query()->firstWhere('barcode', $barcode);

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);

            if ($this->utilization->exists) {
                $this->utilization->products()->firstOrCreate([
                    'product_id' => $product->id,
                ]);
            }
        }
    }

    public function addProduct(): void
    {
        $product = Product::with('product.measure')->whereNotIn('id',
            $this->selectedProducts->pluck('id'))->first();
        if ($product) {
            $this->selectedProducts->push($product);
            if ($this->utilization->exists) {
                $this->utilization->products()->firstOrCreate([
                    'product_id' => $product->id,
                ]);
            }
        }
    }

    public function deleteProduct($productId): void
    {
        if ($this->utilization->exists) {
            $this->utilization->products()->where('product_id', $productId)->delete();
        }
        $this->selectedProducts = $this->selectedProducts->filter(fn($item) => $item->id !== $productId);
    }

    public function render(): View
    {
        return view('livewire.warehouse.utilization.products');
    }
}
