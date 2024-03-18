<?php

namespace App\Livewire\Warehouse\Sale;

use App\Models\Product;
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
        $this->selectedProducts = WarehouseRemainProduct::with('product', 'dicProduct.measure')
            ->whereIn('product_id', old('products', []))
            ->get();
    }

    #[On('confirm')]
    public function search(string $barcode)
    {
        $product = WarehouseRemainProduct::whereHas('product', function (Builder $query) use ($barcode) {
            $query->where('barcode', $barcode);
        })->first();

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);
        }
    }

    public function addProduct()
    {
        $product = WarehouseRemainProduct::with('product', 'dicProduct.measure')->whereNotIn('product_id',
            $this->selectedProducts->pluck('product_id'))->first();
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
