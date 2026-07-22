<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('role_permissions')->insert([
            // Admin (role_id = 1) có tất cả các quyền
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            
            // Staff (role_id = 2) chỉ có quyền quản lý đơn hàng
            ['role_id' => 2, 'permission_id' => 2],
        ]);
    }
}
