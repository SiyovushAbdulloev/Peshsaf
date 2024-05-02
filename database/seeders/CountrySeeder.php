<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('project.countries') as $country) {
            Country::firstOrCreate([
                'name' => $country['name']
            ], [
                'is_favorite' => $country['is_favorite']
            ]);
        }
    }
}
