<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
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
            ]
        );

        $admin->assignRole(Role::ADMIN);
        $warehouse->assignRole(Role::WAREHOUSE);
        $vendor->assignRole(Role::VENDOR);
    }
}
