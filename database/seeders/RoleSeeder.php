<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'support_staff']);
        Role::create(['name' => 'head_of_department']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'super_admin']);
    }
}
