<?php

namespace App\Livewire\Customs\Receipts;

use App\Actions\Customs\ConfirmReceiptAction;
use App\Models\Receipt;
use Livewire\Component;

class Confirm extends Component
{
    public Receipt $receipt;

    public function mount(Receipt $receipt): void
    {
        $this->receipt = $receipt;
    }

    public function render()
    {
        return view('livewire.customs.receipts.confirm');
    }

    public function confirm()
    {
        app(ConfirmReceiptAction::class)->execute($this->receipt);

        session()->flash('success', 'Приход успешно одобрен');

        return $this->redirect(route('customs.receipts.index'));
    }
}
