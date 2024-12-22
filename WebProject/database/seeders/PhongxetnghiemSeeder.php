<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\phongxetnghiem;



class PhongxetnghiemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Lấy tất cả các chỉ số lâm sàng từ bảng canls
        $canlsRecords = DB::table('canls')->get();

        $phongxetnghiemData = [];
        $floor = 1; // Tầng bắt đầu
        $roomCounter = 1; // Số phòng trên tầng

        foreach ($canlsRecords as $canls) {
            // Tính số phòng
            $roomNumber = ($floor * 100) + $roomCounter; // Phòng sẽ có dạng 101, 102, ...

            // Tạo vị trí cho phòng xét nghiệm tại Tòa D
            $vitri = "Khu Xét nghiệm - Tòa D - Tầng {$floor} - Phòng {$roomNumber}";
            $phongxetnghiemData[] = [
                'tenphong' => "Phòng xét nghiệm số {$roomNumber}",
                'vitri' => $vitri,
                'macls' => $canls->macls,
            ];

            // Tăng số phòng
            $roomCounter++;

            // Chuyển sang tầng mới nếu số phòng trên tầng vượt quá 10
            if ($roomCounter > 10) {
                $roomCounter = 1; // Reset số phòng
                $floor++; // Tăng tầng
            }
        }

        // Chèn dữ liệu vào bảng 'phongxetnghiem'
        DB::table('phongxetnghiem')->insert($phongxetnghiemData);
    }
}
