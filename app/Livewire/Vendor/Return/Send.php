<?php

namespace App\Livewire\Vendor\Return;

use App\Models\Refund;
use Livewire\Component;

class Send extends Component
{
    public ?Refund $return = null;

    public function mount(Refund $return)
    {
        $this->return = $return;
    }

    public function submit()
    {
        if ($this->return->status()->canBe('pending')) {
            $this->return->status()->transitionTo('pending');
        }

        session()->flash('success', 'Возврат успешно отправлен');

        return $this->redirect(route('vendor.returns-vendor.index'));
    }

    public function render()
    {
        return view('livewire.vendor.return.send');
    }
}
