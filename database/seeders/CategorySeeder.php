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
                'name' => "Category$i"
            ]);
        }
    }
}
