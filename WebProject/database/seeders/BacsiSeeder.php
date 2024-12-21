<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use App\Models\Bacsi;

class BacsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $filePath = base_path('database/seeders/data/bacsidata.xlsx');

        // Đọc file Excel
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Lấy dữ liệu từ sheet
        $rows = $worksheet->toArray();

        // Bỏ qua hàng đầu tiên nếu là tiêu đề
        $bacsi = [];
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue; // Bỏ qua tiêu đề
            }

            $bacsi[] = [
                'tenbs' => $row[0],                     // Cột "Tên bệnh nhân"
                'ngsinh' => $row[1] ? date('Y-m-d', strtotime($row[1])) : null, // Cột "Ngày sinh"
                'gioitinh' => $row[2],                 // Cột "Giới tính"
                'diachi' => $row[3],                     // Cột "CCCD"
                'sdt' => $row[4],                      // Cột "SĐT"
                'email' => $row[5],                   // Cột "Địa chỉ"
                'hocvi' => $row[6],           // Cột "Ghi chú"
                'chucvu' => $row[7],
                'makhoa' => $row[8],
                'hesoluong' => $row[9],
            ];
        }

        // Chèn dữ liệu vào bảng
        DB::table('bacsi')->insert($bacsi);
    }
}
