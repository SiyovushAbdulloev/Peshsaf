<?php

namespace App\Livewire\Warehouse\Sale;

use App\Actions\Product\GetProductsAction;
use App\Actions\Warehouse\GetNewProductAction;
use App\Models\Dictionaries\Product as DicProduct;
use App\Models\WarehouseRemainProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Products extends Component
{
    public ?Collection $selectedProducts;

    public function mount()
    {
        $this->selectedProducts = app(GetProductsAction::class)->execute(old('products', []));
    }

    #[On('confirm')]
    public function search(string $barcode): void
    {
        $product = app(GetNewProductAction::class)->execute($barcode);

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);
        }
    }

    public function addProduct(): void
    {
        $product = WarehouseRemainProduct::with('product.product', 'dicProduct.measure')
            ->whereHas('product', fn (Builder $query) => $query->active())
            ->whereNotIn('product_id', $this->selectedProducts->pluck('id'))
            ->first();

        if ($product) {
            $this->selectedProducts->push($product->product);
        }
    }

    public function showModal(DicProduct $product): void
    {
        $this->dispatch('show-product', view('product', compact('product'))->render());
    }

    public function deleteProduct($productId): void
    {
        $this->selectedProducts = $this->selectedProducts->filter(fn($item) => $item->id !== $productId);
    }

    public function render()
    {
        return view('livewire.warehouse.sale.products');
    }
}
