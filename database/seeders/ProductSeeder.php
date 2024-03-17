<?php

namespace Database\Seeders;

use App\Models\Dictionaries\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Product::firstOrCreate([
                'name' => "Product$i",
                'status' => 'allowed',
                'category_id' => $i,
                'active_ingredient_id' => $i,
                'measure_id' => $i,
                'country_id' => $i,
                'barcode' => "12345678$i",
                'expiry_date' => Carbon::now()->addMonths($i),
                'description' => "Description$i"
            ]);
        }
    }
}
