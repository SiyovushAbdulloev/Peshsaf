<?php

namespace App\Livewire\Vendor\Return;

use App\Models\Client;
use App\Models\Refund;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Clients extends Component
{
    public Refund $return;

    public ?Collection $clients;

    public ?Client $currentClient = null;

    public string $query = '';

    public function mount(Refund $return)
    {
        $this->return = $return;

        $this->currentClient = Client::find(old('client', $this->return->client_id));
    }

    public function search()
    {
        if (strlen($this->query) > 2) {
            $this->clients = Client::filter(['q' => $this->query])->get();
        }
    }

    public function selectClient(Client $client)
    {
        $this->currentClient = $client;

        $this->dispatch('clientSelected');
    }

    public function render()
    {
        return view('livewire.vendor.return.clients');
    }
}
