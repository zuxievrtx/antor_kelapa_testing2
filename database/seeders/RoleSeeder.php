<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'superadmin', 'guard_name' => 'web']);
        Role::create(['name' => 'kepsek', 'guard_name' => 'web']);
        Role::create(['name' => 'wakahumas', 'guard_name' => 'web']);
        Role::create(['name' => 'kapokja', 'guard_name' => 'web']);
        Role::create(['name' => 'kaprodi', 'guard_name' => 'web']);
        Role::create(['name' => 'guru', 'guard_name' => 'web']);
        Role::create(['name' => 'dudi', 'guard_name' => 'web']);
        Role::create(['name' => 'siswa', 'guard_name' => 'web']);
    }
}
