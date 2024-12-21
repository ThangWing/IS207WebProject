<?php

namespace Database\Seeders;


use App\Models\Lichlamviec;
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
        //
        $totalDoctors = 200;
        $totalDays = 30; // Số ngày làm việc tương lai
        $shifts = ['1', '2'];

        $startDate = Carbon::now(); // Ngày bắt đầu là hôm nay

        $data = [];
        for ($i = 0; $i < $totalDays; $i++) {
            $currentDate = $startDate->copy()->addDays($i);

            foreach ($shifts as $shift) {
                for ($doctorId = 1; $doctorId <= $totalDoctors; $doctorId++) {
                    $data[] = [
                        'mabs' => str_pad($doctorId, 3, '0', STR_PAD_LEFT),
                        'mapk' => str_pad(rand(1, 20), 3, '0', STR_PAD_LEFT), // Random phòng khám (1-20)
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
