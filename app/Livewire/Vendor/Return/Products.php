<?php

namespace App\Livewire\Vendor\Return;

use App\Actions\Product\GetProductsAction;
use App\Actions\Vendor\GetNewProductAction;
use App\Models\Dictionaries\Product as DicProduct;
use App\Models\OutletProduct;
use App\Models\Refund;
use App\StateMachines\StatusProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Products extends Component
{
    public ?Refund $return = null;

    public ?Collection $selectedProducts;

    public function mount(Refund $return): void
    {
        $this->return = $return;

        $this->selectedProducts = app(GetProductsAction::class)->execute($return->products->pluck('product_id')->toArray());
    }

    #[On('confirm')]
    public function search(string $barcode): void
    {
        $product = app(GetNewProductAction::class)->execute($barcode);

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);
            if ($this->return->exists) {
                $this->return->products()->firstOrCreate([
                    'product_id' => $product->id,
                ]);
            }
        }
    }

    public function addProduct(): void
    {
        $product = OutletProduct::query()
            ->whereHas('product', function (Builder $query) {
                $query
                    ->active()
                    ->where('status', StatusProduct::NEW);
            })
            ->whereNotIn('product_id', $this->selectedProducts->pluck('id'))
            ->first()->product;

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);
            if ($this->return?->exists) {
                $this->return->products()->firstOrCreate([
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
        if ($this->return->exists) {
            $this->return->products()->where('product_id', $productId)->delete();
        }
        $this->selectedProducts = $this->selectedProducts->filter(fn($item) => $item->id !== $productId);
    }

    public function render(): View
    {
        return view('livewire.vendor.return.products');
    }
}
