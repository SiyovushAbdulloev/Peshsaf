<?php

namespace App\Livewire\Warehouse\Receipt;

use App\Models\Receipt;
use Livewire\Component;

class GeneratePdf extends Component
{
    public Receipt $receipt;

    public function mount(Receipt $receipt): void
    {
        $this->receipt = $receipt;
    }

    public function generate()
    {
        if ($this->receipt->status()->canBe('finished')) {
            $this->receipt->status()->transitionTo('finished');
        }

        session()->flash('success', 'Файл сгенерирован');
    }

    public function render()
    {
        return view('livewire.warehouse.receipt.generate-pdf');
    }
}
