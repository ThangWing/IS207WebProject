<?php

namespace Database\Seeders;


use App\Models\Lichlamviec;
use App\Models\Bacsi;
use App\Models\phongkham;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LichlamviecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $totalDays = 10; // Số ngày làm việc tương lai
        $shifts = ['1', '2']; // Ca làm việc: 1 - sáng, 2 - chiều

        $startDate = Carbon::now(); // Ngày bắt đầu là hôm nay

        // Lấy danh sách các phòng khám
        $phongkhamList = phongkham::all();

        $data = [];

        for ($i = 0; $i < $totalDays; $i++) {
            $currentDate = $startDate->copy()->addDays($i);

            foreach ($phongkhamList as $phongkham) {
                // Lấy danh sách bác sĩ thuộc khoa của phòng khám
                $bacsiList = Bacsi::where('makhoa', $phongkham->makhoa)->get();

                if ($bacsiList->isEmpty()) {
                    continue; // Nếu không có bác sĩ nào thuộc khoa này, bỏ qua phòng khám
                }

                foreach ($shifts as $shift) {
                    // Chọn ngẫu nhiên một bác sĩ từ danh sách bác sĩ thuộc khoa
                    $bacsi = $bacsiList->random();

                    $data[] = [
                        'mabs' => str_pad($bacsi->mabs, 3, '0', STR_PAD_LEFT),
                        'mapk' => str_pad($phongkham->mapk, 3, '0', STR_PAD_LEFT),
                        'ngaylamviec' => $currentDate->format('Y-m-d'),
                        'calamviec' => $shift,
                    ];
                }
            }
        }

        // Chèn dữ liệu vào bảng
        Lichlamviec::insert($data);
    }
}
