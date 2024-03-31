<?php

namespace App\Livewire\Vendor\Utilization;

use App\Models\Utilization;
use Livewire\Component;

class Finish extends Component
{
    public ?Utilization $utilization = null;

    public function mount(Utilization $utilization)
    {
        $this->utilization = $utilization;
    }

    public function submit()
    {
        if (!$this->utilization->status()->canBe('finished')) {
            session()->flash('error', 'Невозможно провести утилизацию');

            return $this->redirect(url()->previous());
        }
        $this->utilization->status()->transitionTo('finished');

        session()->flash('success', 'Утилизация успешно проведена');

        return $this->redirect(route('vendor.utilizations.index'));
    }

    public function render()
    {
        return view('livewire.vendor.utilization.finish');
    }
}
