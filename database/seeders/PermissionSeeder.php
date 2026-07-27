<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['name' => 'manage-products', 'created_at' => now()],
            ['name' => 'manage-orders', 'created_at' => now()],
            ['name' => 'manage-users', 'created_at' => now()],
        ]);
    }
}
