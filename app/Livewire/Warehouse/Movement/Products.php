<?php

namespace App\Livewire\Warehouse\Movement;

use App\Actions\Warehouse\GetProductAction;
use App\Actions\Warehouse\GetProductsAction;
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

        $this->selectedProducts = app(GetProductsAction::class)->execute($movement->products->pluck('product_id')->toArray());
    }

    #[On('search')]
    public function search(string $barcode)
    {
        $product = app(GetProductAction::class)->execute($barcode);

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
        $product = WarehouseRemainProduct::with('product', 'dicProduct.measure')
            ->whereHas('product', fn (Builder $query) => $query->active())
            ->whereNotIn('product_id', $this->selectedProducts->pluck('product_id'))
            ->first();

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
