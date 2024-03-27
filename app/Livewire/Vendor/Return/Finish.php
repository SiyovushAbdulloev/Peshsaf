<?php

namespace App\Livewire\Vendor\Return;

use App\Models\Refund;
use Livewire\Component;

class Finish extends Component
{
    public ?Refund $return = null;

    public function mount(Refund $return): void
    {
        $this->return = $return;
    }

    public function finish()
    {
        if ($this->return->status()->canBe('finished')) {
            $this->return->status()->transitionTo('finished');
        }

        session()->flash('success', 'Возврат успешно завершен');

        return $this->redirect(route('vendor.returns.clients.index'));
    }

    public function render()
    {
        return view('livewire.vendor.return.finish');
    }
}
