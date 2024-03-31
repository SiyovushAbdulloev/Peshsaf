<?php

namespace App\StateMachines;

use App\Actions\Utilization\OutletAction;
use App\Actions\Utilization\WarehouseAction;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\Role;
use App\Models\Utilization;
use App\Models\Warehouse;
use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusUtilization extends StateMachine
{
    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            'draft' => ['finished'],
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
                    // TODO Warehouse actions
                    match (auth()->user()->role->name) {
                        Role::WAREHOUSE => app(WarehouseAction::class)->execute($model),
                        Role::VENDOR => app(OutletAction::class)->execute($model),
                    };
                },
            ],
        ];
    }
}
