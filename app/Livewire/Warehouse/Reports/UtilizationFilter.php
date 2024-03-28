<?php

namespace App\Livewire\Warehouse\Reports;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class UtilizationFilter extends Component
{
    public array $options;
    public $filters;
    public Collection $outlets;

    public string $option;
    public string $from;
    public string $to;
    public string $outlet;

    public function render()
    {
        return view('livewire.warehouse.reports.utilization-filter');
    }

    public function mount(array $options, Collection $outlets, $filters)
    {
        $this->options = $options;
        $this->filters = $filters;
        $this->outlets = $outlets;
        $this->from = $filters['from'] ?? Carbon::now()->format('d-m-Y');
        $this->to = $filters['to'] ?? Carbon::now()->format('d-m-Y');
        $this->outlet = $filters['outlet'] ?? '';

        $date['from'] = $this->from;
        $date['to'] = $this->to;

        $this->dispatch('update-dates', $date);
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
        $this->redirect(route('warehouse.reports.utilizations.index', ['from' => $this->from, 'to' => $this->to, 'outlet' => $this->outlet]));
    }
}
