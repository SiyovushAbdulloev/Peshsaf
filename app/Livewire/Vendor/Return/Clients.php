<?php

namespace App\Livewire\Vendor\Return;

use App\Models\Client;
use App\Models\Refund;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Clients extends Component
{
    public Refund $return;

    public ?Collection $clients;

    public ?Client $currentClient = null;

    public string $query = '';

    public function mount(Refund $return): void
    {
        $this->return = $return;

        $this->currentClient = Client::find(old('client_id', $this->return->client_id));
    }

    public function search(): void
    {
        if (strlen($this->query) > 2) {
            $this->clients = Client::filter(['q' => $this->query])->get();
        }
    }

    public function selectClient(Client $client): void
    {
        $this->currentClient = $client;

        $this->dispatch('clientSelected');
    }

    public function render(): View
    {
        return view('livewire.vendor.return.clients');
    }
}
