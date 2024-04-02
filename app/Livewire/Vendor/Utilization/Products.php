<?php

namespace App\Livewire\Vendor\Utilization;

use App\Actions\Product\GetProductsAction;
use App\Actions\Product\GetSoldProductAction;
use App\Models\Dictionaries\Product as DicProduct;
use App\Models\Product;
use App\Models\Utilization;
use App\StateMachines\StatusProduct;
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

        $this->selectedProducts = app(GetProductsAction::class)->execute($utilization->products->pluck('product_id')->toArray());
    }

    #[On('search')]
    public function search(string $barcode): void
    {
        $product = app(GetSoldProductAction::class)->execute($barcode);

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
        $product = Product::with('product.measure')
            ->active()
            ->has('product')
            ->where('status', StatusProduct::SOLD)
            ->whereNotIn('id', $this->selectedProducts->pluck('id'))
            ->first();
        if ($product) {
            $this->selectedProducts->push($product);
            if ($this->utilization->exists) {
                $this->utilization->products()->firstOrCreate([
                    'product_id' => $product->id,
                ]);
            }
        }
    }

    public function showModal(DicProduct $product): void
    {
        $this->dispatch('show-product', view('product', compact('product'))->render());
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
        return view('livewire.vendor.utilization.products');
    }
}
