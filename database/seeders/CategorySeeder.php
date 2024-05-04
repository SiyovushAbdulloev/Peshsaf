<?php

namespace Database\Seeders;

use App\Models\Dictionaries\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Category::firstOrCreate([
                'name' => "Category$i",
                'code' => str_pad($i, 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
