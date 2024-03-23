<?php

namespace App\Livewire\Vendor\Return;

use App\Models\Client;
use App\Models\OutletProduct;
use App\Models\Refund;
use App\Models\SaleProduct;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Products extends Component
{
    public ?Collection $selectedProducts;
    public ?Client $client;

    public function mount(Refund $return)
    {
        $products = [];
        foreach ($return->products as $p) {
            $products[] = $p->product;
        }

        $this->selectedProducts = collect($products);
    }

    #[On('confirm')]
    public function search(string $barcode)
    {
        $saledProduct = SaleProduct::with('sale.client')->whereHas('product', function (Builder $query) use ($barcode) {
            $query->where('barcode', $barcode);
        })->first();

        $this->dispatch('show-client', $saledProduct->sale->client);

        $product = OutletProduct::with('dicProduct.measure', 'product')->whereHas('product', function (Builder $query) use ($barcode) {
            $query->where('barcode', $barcode);
        })->first();

        if ($product && !$this->selectedProducts->contains('barcode', $product->barcode)) {
            $this->selectedProducts->push($product);
        }
    }

    public function deleteProduct($productId): void
    {
        $this->selectedProducts = $this->selectedProducts->filter(fn ($item) => $item->id !== $productId);
    }

    public function render()
    {
        return view('livewire.vendor.return.products');
    }
}
