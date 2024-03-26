<?php

namespace App\Livewire\Vendor\Receipts;

use App\Actions\Vendor\Receipt\ApproveAction;
use App\Models\Movement;
use Livewire\Component;

class Approve extends Component
{
    public Movement $receipt;

    public function mount(Movement $receipt): void
    {
        $this->receipt = $receipt;
    }

    public function render()
    {
        return view('livewire.vendor.receipts.approve');
    }

    public function approve()
    {
        app(ApproveAction::class)->execute($this->receipt);

        if ($this->receipt->status()->canBe('approved')) {
            $this->receipt->status()->transitionTo('approved');
        }

        session()->flash('success', 'Приход успешно одобрен');

        return $this->redirect(route('vendor.receipts.index'));
    }
}
