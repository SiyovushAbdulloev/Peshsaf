<?php

namespace App\StateMachines;

use App\Actions\Warehouse\RemoveWarehouseProductAction;
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
