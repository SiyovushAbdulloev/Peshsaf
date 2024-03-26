<?php

namespace App\Livewire\Warehouse\Return;

use App\Actions\Warehouse\Return\ApproveAction;
use App\Models\Refund;
use Livewire\Component;

class Approve extends Component
{
    public Refund $return;

    public function mount($return): void
    {
        $this->return = $return;
    }

    public function approve()
    {
        app(ApproveAction::class)->execute($this->return);

        return redirect(route('warehouse.returns.index'))->with('success', 'Возврат успешно одобрен');
    }

    public function render()
    {
        return view('livewire.warehouse.return.approve');
    }
}
