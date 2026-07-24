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
                'password' => Hash::make('12345678'),
                'phone' => '0967455398',
                'avatar' => 'admin.jpg',
                'role_id' => 1,
                'status' => 'active',
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'stafffadegra@gmail.com'],
            [
                'name' => 'Nhân Viên',
                'password' => Hash::make('12345678'),
                'phone' => '0977777777',
                'avatar' => 'staff.jpg',
                'role_id' => 2,
                'status' => 'active',
                'updated_at' => now(),
            ]
        );

        DB::table('users')->updateOrInsert(
            ['email' => 'customerfadegra@gmail.com'],
            [
                'name' => 'Khách Hàng',
                'password' => Hash::make('12345678'),
                'phone' => '0988888888',
                'avatar' => 'customer.jpg',
                'role_id' => 3,
                'status' => 'active',
                'updated_at' => now(),
            ]
        );
    }
}
