<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 3; $i++) {
            Supplier::firstOrCreate([
                'organization_name'    => "Organization$i",
                'full_name'            => "Supplier$i",
                'country_id'           => $i,
                'organization_address' => "Address$i",
                'phone'                => "93755500$i",
                'email'                => "supplier$i@admin.com",
                'description'          => "Description$i",
                'code'                 => str_pad($i, 3, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
