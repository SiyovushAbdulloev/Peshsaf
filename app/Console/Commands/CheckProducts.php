<?php

namespace App\Console\Commands;

use App\Jobs\SendNotification;
use App\Models\Dictionaries\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка срока годности товаров';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::query()
            ->whereBetween('expiry_date', [
                Carbon::now()->format('Y-m-d'),
                Carbon::now()->addMonth()->format('Y-m-d'),
            ])->get();

        $products->each(function ($product) {
            $body = match ($product->expiry_date->diffInDays(Carbon::now()->format('Y-m-d'))) {
                30 => sprintf('Срок годности товара <b>%s</b> истекает через 30 дней', $product->name),
                10 => sprintf('Срок годности товара <b>%s</b> истекает через 10 дней', $product->name),
                3 => sprintf('Срок годности товара <b>%s</b> истекает через 3 дня', $product->name),
                0 => sprintf('Срок годности товара <b>%s</b> истек', $product->name),
            };

            SendNotification::dispatch(
                User::role('admin')->first()->id,
                'Срок годности товара',
                $body,
                route('admin.dictionaries.categories.products.edit',
                    ['category' => $product->category_id, $product->id])
            );
        });
    }
}
