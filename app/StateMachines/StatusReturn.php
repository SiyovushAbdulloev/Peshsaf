<?php

namespace App\StateMachines;

use App\Actions\Vendor\Return\Client\FinishAction;
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

    public function afterTransitionHooks(): array
    {
        return [
            'finished' => [
                function ($from, $model) {
                    if ($from === self::DRAFT) {
                        app(FinishAction::class)->execute($model);
                    }
                },
            ],
        ];
    }
}
