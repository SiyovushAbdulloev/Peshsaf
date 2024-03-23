<?php

namespace App\Livewire\Warehouse\Utilization;

use App\Models\Client;
use App\Models\Outlet;
use App\Models\Utilization;
use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{
    public bool $client = false;

    public string $type = 'outlet';

    public Collection $outlets;

    public Collection $clients;

    public ?Utilization $utilization = null;

    public function mount(Utilization $utilization = null): void
    {
        $this->outlets = Outlet::get();
        $this->clients = Client::get();

        $this->utilization = $utilization;
        if (old('type', $this->utilization?->type) === Utilization::CLIENT) {
            $this->client = true;
        }
    }

    public function change()
    {
        $this->client = $this->type === 'client';
    }

    public function render()
    {
        return view('livewire.warehouse.utilization.create');
    }
}
