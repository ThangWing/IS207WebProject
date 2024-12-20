<?php

namespace Database\Seeders;

use App\Models\phongkham;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhongKhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $khoaIds = DB::table('khoa')->pluck('makhoa'); // Lấy tất cả mã khoa

        $phongkhamData = [];
        $currentBuilding = 'A'; // Bắt đầu từ Tòa A
        $floor = 1; // Tầng bắt đầu
        $roomCounter = 1; // Số phòng trên tầng

        foreach ($khoaIds as $makhoa) {
            // Tính số phòng
            $roomNumber = ($floor * 100) + $roomCounter; // Phòng sẽ có dạng 101, 102, ...

            // Tạo vị trí cho phòng khám
            $vitri = "Khu Khám bệnh - Tòa {$currentBuilding} - Tầng {$floor} - Phòng {$roomNumber}";
            $phongkhamData[] = [
                'tenphong' => "Phòng khám số {$roomNumber}",
                'vitri' => $vitri,
                'makhoa' => $makhoa,
            ];

            // Tăng số phòng
            $roomCounter++;

            // Chuyển sang tầng mới nếu số phòng trên tầng vượt quá 10
            if ($roomCounter > 10) {
                $roomCounter = 1; // Reset số phòng
                $floor++; // Tăng tầng
            }

            // Chuyển sang tòa nhà mới nếu tầng vượt quá 5 (giả định mỗi tòa có tối đa 5 tầng)
            if ($floor > 5) {
                $floor = 1; // Reset tầng
                $currentBuilding = ($currentBuilding === 'A') ? 'B' : 'A'; // Đổi tòa nhà
            }
        }

        // Chèn dữ liệu vào bảng 'phongkham'
        DB::table('phongkham')->insert($phongkhamData);
    }
        }