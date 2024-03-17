<?php

namespace Database\Seeders;

use App\Models\Dictionaries\ActiveIngredient;
use Illuminate\Database\Seeder;

class ActiveIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            ActiveIngredient::firstOrCreate([
                'name' => "ActiveIngredient$i"
            ]);
        }
    }
}
