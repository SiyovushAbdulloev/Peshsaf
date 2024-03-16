<?php

namespace App\Livewire\Warehouse\Movement;

use App\Models\Movement;
use Livewire\Component;

class Send extends Component
{
    public ?Movement $movement = null;

    public function mount(Movement $movement)
    {
        $this->movement = $movement;
    }

    public function submit()
    {
        if ($this->movement->status()->canBe('approving')) {
            $this->movement->status()->transitionTo('approving');
        }

        session()->flash('success', 'Приход успешно отправлен');

        return $this->redirect(route('warehouse.movements.index'));
    }

    public function render()
    {
        return view('livewire.warehouse.movement.send');
    }
}
