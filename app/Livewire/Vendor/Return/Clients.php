<?php

namespace App\Livewire\Vendor\Return;

use App\Models\Refund;
use Livewire\Attributes\On;
use Livewire\Component;

class Clients extends Component
{
    public ?array $client = null;

    public function render()
    {
        return view('livewire.vendor.return.clients');
    }

    public function mount(Refund $return)
    {
        $this->client = $return->client?->toArray();
    }

    #[On('show-client')]
    public function showClient($client)
    {
        if (!$this->client) {
            $this->client = $client;
        }
    }
}
