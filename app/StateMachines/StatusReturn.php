<?php

namespace App\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusReturn extends StateMachine
{
    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            'draft'     => ['pending'],
            'pending' => ['finished'],
        ];
    }

    public function defaultState(): ?string
    {
        return 'draft';
    }
}
