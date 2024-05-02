<?php

namespace App\StateMachines;

use App\Actions\Warehouse\Receipt\GeneratePdfAction;
use App\Events\NotificationsEvent;
use App\Jobs\SendNotification;
use App\Models\NotificationMessage;
use App\Models\User;
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
            'on_approval' => [
                function ($from, $model) {
                    SendNotification::dispatch(
                        User::role('customs')->first()->id,
                        'Новый приход',
                        sprintf('Поступило новое перемещение от склада <b>%s</b>', $model->warehouse->name),
                        route('customs.receipts.show', $model)
                    );
                },
            ],
            'finished'    => [
                function ($from, $model) {
                    app(GeneratePdfAction::class)->execute($model);
                },
            ],
        ];
    }
}
