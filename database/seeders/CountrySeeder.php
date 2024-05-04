<?php

namespace Database\Seeders;

use App\Models\Dictionaries\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('project.countries') as $index => $country) {
            Country::firstOrCreate([
                'name' => $country['name'],
                'code' => str_pad($index + 1, 3, '0', STR_PAD_LEFT),
            ], [
                'is_favorite' => $country['is_favorite'] ?? false,
            ]);
        }
    }
}
