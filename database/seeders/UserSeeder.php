<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin   = User::firstOrCreate(
            [
                'email' => 'admin@admin.com',
            ],
            [
                'name'     => 'Admin',
                'email'    => 'admin@admin.com',
                'password' => bcrypt('password'),
                'is_limited' => false,
                'phone' => '100000000',
                'position_id' => 1,
                'address' => 'Some address',
            ]
        );
        $warehouse = User::firstOrCreate(
            [
                'email' => 'warehouse@admin.com',
            ],
            [
                'name'     => 'Завсклад',
                'email'    => 'warehouse@admin.com',
                'password' => bcrypt('password'),
                'is_limited' => true,
                'expired' => now(),
                'phone' => '100000001',
                'position_id' => 2,
                'address' => 'Tajikistan',
            ]
        );
        $vendor  = User::firstOrCreate(
            [
                'email' => 'vendor@admin.com',
            ],
            [
                'name'     => 'Завсклад',
                'email'    => 'vendor@admin.com',
                'password' => bcrypt('password'),
                'is_limited' => true,
                'expired' => Carbon::now()->addMonth(),
                'phone' => '100000002',
                'position_id' => 3,
                'address' => 'Russia',
            ]
        );

        $admin->assignRole(Role::ADMIN);
        $warehouse->assignRole(Role::WAREHOUSE);
        $vendor->assignRole(Role::VENDOR);
    }
}
