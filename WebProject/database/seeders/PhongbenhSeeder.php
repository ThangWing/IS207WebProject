<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\phongbenh;

class PhongbenhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy tất cả các phòng khám từ bảng phongkham
        $phongkhamRecords = DB::table('phongkham')->get();

        $phongbenhData = [];
        $floor = 1; // Tầng bắt đầu
        $roomCounter = 1; // Số phòng trên tầng

        foreach ($phongkhamRecords as $phongkham) {
            // Tạo 2 phòng bệnh cho mỗi phòng khám
            for ($i = 1; $i <= 2; $i++) {
                // Tạo vị trí phòng bệnh tại Tòa C
                $roomNumber = ($floor * 100) + $roomCounter; // Phòng sẽ có dạng 101, 102, ...
                $vitri = "Khu Điều trị - Tòa C - Tầng {$floor} - Phòng {$roomNumber}";

                $phongbenhData[] = [
                    'tenphong' => "Phòng bệnh số {$roomNumber}",
                    'vitri' => $vitri,
                    'loaidv' => ($i % 2 == 0) ? 'VIP' : 'Bình thường', // Luân phiên giữa VIP và Bình thường
                    'makhoa' => $phongkham->makhoa,
                ];

                // Tăng số phòng
                $roomCounter++;

                // Chuyển sang tầng mới nếu số phòng trên tầng vượt quá 10
                if ($roomCounter > 10) {
                    $roomCounter = 1; // Reset số phòng
                    $floor++; // Tăng tầng
                }
            }
        }

        // Chèn dữ liệu vào bảng 'phongbenh'
        DB::table('phongbenh')->insert($phongbenhData);
    }
}
