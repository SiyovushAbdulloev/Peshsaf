<?php

namespace App\Livewire\Warehouse\Sale;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Clients extends Component
{
    public ?string $query = null;

    public ?Collection $clients = null;

    public function render()
    {
        return view('livewire.warehouse.sale.clients');
    }

    public function search()
    {
        $this->clients = null;
        if (strlen($this->query) > 2) {
            $this->clients = Client::filter(['q' => $this->query])->get();
        }
    }
}
