<?php

namespace App\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusReceipt extends StateMachine
{
    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            'draft'       => ['on_approval'],
            'on_approval' => ['finished', 'draft'],
        ];
    }

    public function defaultState(): ?string
    {
        return 'draft';
    }
}
