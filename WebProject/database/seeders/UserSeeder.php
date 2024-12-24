<?php

namespace Database\Seeders;

use App\Models\User;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' =>'admin123', // Mật khẩu cho admin
                'role' => 1, // Vai trò admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Doctor Tâm',
                'email' => 'tamvh@bv.com',
                'password' => 'doctor123', // Mật khẩu cho bác sĩ
                'role' => 2, // Vai trò bác sĩ
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lễ Tân',
                'email' => 'staff@example.com',
                'password' =>'staff123', // Mật khẩu cho nhân viên
                'role' => 3, // Vai trò nhân viên
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
