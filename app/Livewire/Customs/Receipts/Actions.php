<?php

namespace App\Livewire\Customs\Receipts;

use App\Actions\Customs\ConfirmReceiptAction;
use App\Models\Receipt;
use Livewire\Component;

class Actions extends Component
{
    public Receipt $receipt;

    public function mount(Receipt $receipt): void
    {
        $this->receipt = $receipt;
    }

    public function render()
    {
        return view('livewire.customs.receipts.actions');
    }

    public function confirm()
    {
        app(ConfirmReceiptAction::class)->execute($this->receipt);

        session()->flash('success', 'Приход успешно одобрен');

        return $this->redirect(route('customs.receipts.index'));
    }

    public function reject()
    {
        if ($this->receipt->status()->canBe('rejected')) {
            $this->receipt->status()->transitionTo('rejected');
        }

        session()->flash('success', 'Приход успешно отклонен');

        return $this->redirect(route('customs.receipts.index'));
    }
}
