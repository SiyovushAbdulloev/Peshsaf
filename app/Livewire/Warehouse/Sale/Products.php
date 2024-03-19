<?php

namespace App\Livewire\Warehouse\Sale;

use App\Actions\Warehouse\GetProductAction;
use App\Actions\Warehouse\GetProductsAction;
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
        $this->selectedProducts = app(GetProductsAction::class)->execute();
    }

    #[On('confirm')]
    public function search(string $barcode)
    {
        $product = app(GetProductAction::class)->execute($barcode);

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);
        }
    }

    public function addProduct()
    {
        $product = WarehouseRemainProduct::with('product', 'dicProduct.measure')
            ->whereHas('product', fn (Builder $query) => $query->active())
            ->whereNotIn('product_id', $this->selectedProducts->pluck('product_id'))
            ->first();
        if ($product) {
            $this->selectedProducts->push($product);
        }
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
