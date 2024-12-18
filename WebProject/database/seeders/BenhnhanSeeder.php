<?php

namespace Database\Seeders;

use App\Models\Benhnhan;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class BenhnhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $filePath = base_path('database/seeders/data/benhnhan_data.xlsx');

        // Đọc file Excel
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Lấy dữ liệu từ sheet
        $rows = $worksheet->toArray();

        // Bỏ qua hàng đầu tiên nếu là tiêu đề
        $benhnhan = [];
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue; // Bỏ qua tiêu đề
            }

            $benhnhan[] = [
                'tenbn' => $row[0],                     // Cột "Tên bệnh nhân"
                'ngsinh' => $row[1] ? date('Y-m-d', strtotime($row[1])) : null, // Cột "Ngày sinh"
                'gioitinh' => $row[2],                 // Cột "Giới tính"
                'cccd' => $row[3],                     // Cột "CCCD"
                'sdt' => $row[4],                      // Cột "SĐT"
                'diachi' => $row[5],                   // Cột "Địa chỉ"
                'ghichu' => $row[6] ?? null,           // Cột "Ghi chú"
            ];
        }

        // Chèn dữ liệu vào bảng
        DB::table('benhnhan')->insert($benhnhan);
    }
}
