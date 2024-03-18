<?php

namespace App\StateMachines;

use App\Models\Product;
use Asantibanez\LaravelEloquentStateMachines\StateMachines\StateMachine;

class StatusProduct extends StateMachine
{
    public function recordHistory(): bool
    {
        return false;
    }

    public function transitions(): array
    {
        return [
            'new'  => ['sold'],
            'sold' => ['used', 'utilized'],
            'used' => ['utilized'],
        ];
    }

    public function defaultState(): ?string
    {
        return 'new';
    }

    public function beforeTransitionHooks(): array
    {
        return [
            'sold' => [
                function ($to, $model) {
                    $this->makeReturned($model);
                },
            ],
            'used' => [
                function ($to, $model) {
                    $this->makeReturned($model);
                },
            ],
        ];
    }

    private function makeReturned(Product $product): void
    {
        logger('product utilizied');
        // TODO check client not returned products
        // if exists, then make returned
    }
}
