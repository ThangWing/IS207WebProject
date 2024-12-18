<?php

namespace Database\Seeders;

use App\Models\Bhyt;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class BHYTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $filePath = base_path('database/seeders/data/BHYT_data.xlsx');

        // Đọc file Excel
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Lấy dữ liệu từ sheet
        $rows = $worksheet->toArray();

        // Bỏ qua hàng đầu tiên nếu là tiêu đề
        $bhyt = [];
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue; // Bỏ qua tiêu đề
            }

            $bhyt[] = [
                'mabn' => $row[0],                     // Cột "Tên bệnh nhân"
                'ma_the' => $row[1], // Cột "Ngày sinh"
                'doituong' => $row[2],                 // Cột "Giới tính"
                'ngay_hieu_luc' => $row[3] ? date('Y-m-d', strtotime($row[1])) : null,                     // Cột "CCCD"
                'ngay_het_han' => $row[4] ? date('Y-m-d', strtotime($row[1])) : null,                      // Cột "SĐT"
                'noi_dang_ky' => $row[5],                   // Cột "Địa chỉ"
            ];
        }

        // Chèn dữ liệu vào bảng
        DB::table('bhyt')->insert($bhyt);
    }
}
