<?php

namespace App\Livewire\Vendor\Sale;

use App\Actions\Product\GetProductsAction;
use App\Actions\Vendor\GetNewProductAction;
use App\Models\Dictionaries\Product as DicProduct;
use App\Models\OutletProduct;
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
    public function search(string $barcode)
    {
        $outletProduct = app(GetNewProductAction::class)->execute($barcode);

        if ($outletProduct && !$this->selectedProducts->contains('barcode', $outletProduct->product->barcode)) {
            $this->selectedProducts->push($outletProduct->product);
        }
    }

    public function addProduct()
    {
        $outletProduct = OutletProduct::with('product', 'dicProduct.measure')
            ->whereHas('product', fn (Builder $query) => $query->active())
            ->whereNotIn('product_id', $this->selectedProducts->pluck('id'))
            ->first();

        if ($outletProduct) {
            $this->selectedProducts->push($outletProduct->product);
        }
    }

    public function showModal(DicProduct $product): void
    {
        $this->dispatch('show-product', view('product', compact('product'))->render());
    }

    public function deleteProduct($productId): void
    {
        $this->selectedProducts = $this->selectedProducts->filter(fn ($item) => $item->id !== $productId);
    }

    public function render()
    {
        return view('livewire.vendor.sale.products');
    }
}
