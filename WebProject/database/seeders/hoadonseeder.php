<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoaDonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dữ liệu mẫu cho bảng HoaDon
        $hoaDon = [
            [
                'thoi_gian_tao' => '2023-01-01 12:00:00',
                'tong_tien' => 1000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-02-01 14:00:00',
                'tong_tien' => 2000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-03-01 16:00:00',
                'tong_tien' => 3000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-04-01 18:00:00',
                'tong_tien' => 4000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-05-01 20:00:00',
                'tong_tien' => 5000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-06-01 12:00:00',
                'tong_tien' => 6000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-07-01 14:00:00',
                'tong_tien' => 7000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-08-01 16:00:00',
                'tong_tien' => 8000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-09-01 18:00:00',
                'tong_tien' => 9000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-10-01 20:00:00',
                'tong_tien' => 10000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-11-01 12:00:00',
                'tong_tien' => 11000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2023-12-01 14:00:00',
                'tong_tien' => 12000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2024-01-01 16:00:00',
                'tong_tien' => 13000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2024-02-01 18:00:00',
                'tong_tien' => 14000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2024-03-01 20:00:00',
                'tong_tien' => 15000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2024-04-01 12:00:00',
                'tong_tien' => 16000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2024-05-01 14:00:00',
                'tong_tien' => 17000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2024-06-01 16:00:00',
                'tong_tien' => 18000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2024-07-01 18:00:00',
                'tong_tien' => 19000000,
                'trang_thai' => 'da_thanh_toan',
            ],
            [
                'thoi_gian_tao' => '2024-08-01 20:00:00',
                'tong_tien' => 20000000,
                'trang_thai' => 'da_thanh_toan',
            ],
        ];

        // Chèn dữ liệu vào bảng
        DB::table('hoa_dons')->insert($hoaDon);
    }
}
