<?php

namespace App\StateMachines;

use App\Actions\Warehouse\RemoveWarehouseProductAction;
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

    public function afterTransitionHooks(): array
    {
        return [
            'approved' => [
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
