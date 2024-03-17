<?php

namespace App\Livewire\Warehouse\Movement;

use App\Models\Movement;
use App\Models\WarehouseRemainProduct;
use Illuminate\Database\Eloquent\Builder;
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

        $this->selectedProducts = WarehouseRemainProduct::with('product', 'dicProduct.measure')
            ->whereIn('product_id', old('products', $movement->products->pluck('product_id')))
            ->get();
    }

    #[On('search')]
    public function search(string $barcode)
    {
        $product = WarehouseRemainProduct::query()->whereHas('product', function (Builder $query) use ($barcode) {
            $query->where('barcode', $barcode);
        })->first();

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);

            if ($this->movement->exists) {
                $this->movement->products()->firstOrCreate([
                    'product_id' => $product->id,
                ]);
            }
        }
    }

    public function addProduct()
    {
        $product = WarehouseRemainProduct::with('product', 'dicProduct.measure')->whereNotIn('product_id',
            $this->selectedProducts->pluck('product_id'))->first();
        if ($product) {
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
