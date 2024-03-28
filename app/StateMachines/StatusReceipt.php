<?php

namespace App\StateMachines;

use App\Actions\Warehouse\Receipt\GeneratePdfAction;
use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusReceipt extends StateMachine
{
    const DRAFT = 'draft';

    const ON_APPROVAL = 'on_approval';

    const APPROVED = 'approved';

    const FINISHED = 'finished';

    const REJECTED = 'rejected';

    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            'draft'       => ['on_approval'],
            'on_approval' => ['approved', 'rejected'],
            'approved'    => ['finished'],
            'rejected'    => ['on_approval'],
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
                    app(GeneratePdfAction::class)->execute($model);
                },
            ],
        ];
    }
}
