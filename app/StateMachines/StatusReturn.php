<?php

namespace App\StateMachines;

use App\Actions\Vendor\Return\Client\FinishAction;
use App\Jobs\SendNotification;
use App\Models\User;
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
            'pending' => [
                function ($from, $model) {
                    SendNotification::dispatch(
                        $model->warehouse->user?->id,
                        'Новый возврат',
                        sprintf('Поступил возврат от торговой точки <b>%s</b>', $model->origin->name),
                        route('warehouse.returns.show', $model)
                    );
                },
            ],
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
