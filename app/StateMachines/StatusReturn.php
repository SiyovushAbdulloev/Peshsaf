<?php

namespace App\StateMachines;

use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusReturn extends StateMachine
{
    const PENDING = 'pending';

    const DRAFT = 'draft';

    const FINISHED = 'finished';

    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            'draft'   => ['pending', 'finished'],
            'pending' => ['finished'],
        ];
    }

    public function defaultState(): ?string
    {
        return 'draft';
    }
}
