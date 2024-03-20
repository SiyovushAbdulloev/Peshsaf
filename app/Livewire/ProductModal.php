<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductModal extends Component
{
    public $record;

    protected $listeners = ['can-show' => 'showModal'];

    public function render()
    {
        return view('livewire.product-modal');
    }

    #[Computed]
    public function product()
    {
        return $this->record;
    }

    public function showModal($record)
    {
        $this->record = $record;
        $this->dispatch('show-product-again');
    }
}
