<?php

namespace App\Livewire\Warehouse\Reports;

use Carbon\Carbon;
use Livewire\Component;

class RemainFilter extends Component
{
    public array $options;

    public string $option;
    public string $from;
    public string $to;

    public function render()
    {
        return view('livewire.warehouse.reports.remain-filter');
    }

    public function mount(array $options)
    {
        $this->options = $options;
        $this->from = Carbon::now()->format('d-m-Y');
        $this->to = Carbon::now()->format('d-m-Y');
    }

    public function setDates()
    {
        $date = config("project.filter-dates.dates.{$this->option}");
        $date['from'] = $date['from']->format('d-m-Y');
        $date['to'] = $date['to']->format('d-m-Y');

        $this->from = $date['from'];
        $this->to = $date['to'];

        $this->dispatch('update-dates', $date);
    }

    public function search()
    {
        $this->redirect(route('warehouse.reports.remains.index', ['from' => $this->from, 'to' => $this->to]));
    }
}
