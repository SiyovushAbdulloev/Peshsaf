<?php

namespace App\Console\Commands;

use App\Jobs\SendNotification;
use App\Models\Dictionaries\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка пользователей';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::query()
            ->whereBetween('expired', [
                Carbon::now()->format('Y-m-d'),
                Carbon::now()->addMonth()->format('Y-m-d'),
            ])->get();

        $users->each(function ($user) {
            $body = match ($user->expired->diffInDays(Carbon::now()->format('Y-m-d'))) {
                30 => sprintf('Доступ к системе для пользователя <b>%s</b> будет ограничен через 30 дней', $user->name),
                10 => sprintf('Доступ к системе для пользователя <b>%s</b> будет ограничен через 10 дней', $user->name),
                3 => sprintf('Доступ к системе для пользователя <b>%s</b> будет ограничен через 3 дня', $user->name),
            };

            SendNotification::dispatch(
                User::role('admin')->first()->id,
                'Доступ пользователя',
                $body,
                route('admin.users.edit', compact('user'))
            );
        });
    }
}
