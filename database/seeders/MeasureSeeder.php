<?php

namespace Database\Seeders;

use App\Models\Dictionaries\Measure;
use Illuminate\Database\Seeder;

class MeasureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Measure::firstOrCreate([
                'name' => "Measure$i"
            ]);
        }
    }
}
