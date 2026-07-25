<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'adminfadegra@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456'),
                'phone' => '0967455398',
                'avatar' => 'admin.jpg',
                'role_id' => 1,
                'role' => 'admin',
                'status' => 'active',
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'nhanvienfadegra@gmail.com'],
            [
                'name' => 'Nhân Viên',
                'password' => Hash::make('123456'),
                'phone' => '0977777777',
                'avatar' => 'staff.jpg',
                'role_id' => 2,
                'role' => 'staff',
                'status' => 'active',
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'customerfadegra@gmail.com'],
            [
                'name' => 'Khách Hàng',
                'password' => Hash::make('123456'),
                'phone' => '0988888888',
                'avatar' => 'customer.jpg',
                'role_id' => 3,
                'role' => 'customer',
                'status' => 'active',
                'updated_at' => now(),
            ]
        );
    }
}
