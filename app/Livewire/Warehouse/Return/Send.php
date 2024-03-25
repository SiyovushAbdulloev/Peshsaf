<?php

namespace App\Livewire\Warehouse\Return;

use App\Actions\Warehouse\AddWarehouseProductAction;
use App\Models\OutletProduct;
use App\Models\Product;
use App\Models\Refund;
use App\Models\RefundProduct;
use App\StateMachines\StatusReturn;
use Livewire\Component;

class Send extends Component
{
    public Refund $record;

    public function render()
    {
        return view('livewire.warehouse.return.send');
    }

    public function mount($record)
    {
        $this->record = $record;
    }

    public function approve()
    {
        $products = RefundProduct::where('refund_id', $this->record->id)->get();

        foreach ($products as $p) {
            OutletProduct::where('product_id', $p->product_id)->delete();
            
            $product = Product::find($p->product_id);
            $newProduct = $product->replicate();
            $newProduct->model_type = Refund::class;
            $newProduct->model_id = $this->record->id;
            $newProduct->save();

            app(AddWarehouseProductAction::class)->execute($this->record->warehouse_id, $newProduct);

            $product->history = true;
            $product->save();
        }

        $this->record->status()->transitionTo(StatusReturn::FINISHED);

        return redirect(route('warehouse.returns.index'))->with('success', 'Возврат успешно обновлен');
    }
}
