<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Quản Trị Viên',
                'email' => 'admin@fadegra.com',
                'password' => Hash::make('12345678'),
                'phone' => '0909123456',
                'avatar' => 'admin.jpg',
                'role_id' => 1, // role_id = 1 là admin
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Khách Hàng Mẫu',
                'email' => 'customer@fadegra.com',
                'password' => Hash::make('12345678'),
                'phone' => '0988888888',
                'avatar' => 'customer.jpg',
                'role_id' => 3, // role_id = 3 là customer
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
