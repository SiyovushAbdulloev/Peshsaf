<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = config('project.roles');

        foreach ($roles as $role => $value) {
            Role::firstOrCreate([
                'name'        => $role,
                'description' => $value['description'],
            ]);
        }

    }
}
