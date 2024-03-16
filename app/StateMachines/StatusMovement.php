<?php

namespace App\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusMovement extends StateMachine
{
    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            'draft'     => ['approving'],
            'approving' => ['approved'],
        ];
    }

    public function defaultState(): ?string
    {
        return 'draft';
    }
}
