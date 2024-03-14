<?php

namespace App\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusSale extends StateMachine
{
    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            'new'  => ['sold'],
            'sold' => ['used'],
            'used' => ['utilized'],
        ];
    }

    public function defaultState(): ?string
    {
        return 'new';
    }
}
