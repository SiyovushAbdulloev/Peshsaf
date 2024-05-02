<?php

namespace App\StateMachines;

use App\Actions\Warehouse\RemoveWarehouseProductAction;
use App\Events\NotificationsEvent;
use App\Jobs\SendNotification;
use App\Models\NotificationMessage;
use App\Models\Outlet;
use App\Models\User;
use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusMovement extends StateMachine
{
    const DRAFT = 'draft';

    const APPROVING = 'approving';

    const APPROVED = 'approved';

    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            self::DRAFT     => [self::APPROVING],
            self::APPROVING => [self::APPROVED],
        ];
    }

    public function defaultState(): ?string
    {
        return self::DRAFT;
    }

    public function afterTransitionHooks(): array
    {
        return [
            self::APPROVING => [
                function ($from, $model) {
                    $body = sprintf('Поступило новое перемещение от склада <b>%s</b>', $model->model->name);

                    if ($model->model_type === Outlet::class) {
                        $body = sprintf('Поступило новое перемещение от торговой точки <b>%s</b>', $model->model->name);
                    }
                    SendNotification::dispatch(
                        $model->outlet->user?->id,
                        'Новый приход',
                        $body,
                        route('vendor.receipts.show', $model)
                    );
                }
            ],
            self::APPROVED => [
                function ($from, $model) {
                    foreach ($model->products as $movementProduct) {
                        // Удаляем товар из остатков склада
                        app(RemoveWarehouseProductAction::class)->execute($movementProduct->product);
                    }
                },
            ],
        ];
    }
}
