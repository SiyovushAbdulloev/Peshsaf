<?php

namespace App\Livewire\Vendor\Return;

use App\Actions\Vendor\Return\GetProductsAction;
use App\Models\OutletProduct;
use App\Models\Refund;
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
        $outletProduct = OutletProduct::with('warehouse')
            ->whereHas('product', function (Builder $query) use ($barcode) {
                $query->where('barcode', $barcode);
            })
            ->first();

        if ($outletProduct && !$this->selectedProducts->contains('product.barcode', $outletProduct->product->barcode)) {
            $this->selectedProducts->push($outletProduct);
            if ($this->return->exists) {
                $this->return->products()->firstOrCreate([
                    'product_id' => $outletProduct->product_id,
                ]);
            }
        }
    }

    public function addProduct(): void
    {
        $outletProduct = OutletProduct::with('warehouse')
            ->whereNotIn('product_id', $this->selectedProducts->pluck('product_id'))
            ->first();

        if ($outletProduct && !$this->selectedProducts->contains('product.barcode', $outletProduct->product->barcode)) {
            $this->selectedProducts->push($outletProduct);
            if ($this->return?->exists) {
                $this->return->products()->firstOrCreate([
                    'product_id' => $outletProduct->product_id,
                ]);
            }
        }
    }

    public function deleteProduct($productId): void
    {
        if ($this->return->exists) {
            $this->return->products()->where('product_id', $productId)->delete();
        }
        $this->selectedProducts = $this->selectedProducts->filter(fn ($item) => $item->product_id !== $productId);
    }

    public function render(): View
    {
        return view('livewire.vendor.return.products');
    }
}
