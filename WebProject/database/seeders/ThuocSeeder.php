<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class ThuocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $filePath = base_path('database/seeders/data/Thuoc_cap_nhat.xlsx');

        // Đọc file Excel
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Lấy dữ liệu từ sheet
        $rows = $worksheet->toArray();

        // Bỏ qua hàng đầu tiên nếu là tiêu đề
        $thuoc = [];
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue; // Bỏ qua tiêu đề
            }

            $thuoc[] = [
                'tenthuoc' => $row[0],               // Cột "Tên thuốc"
                'donvi' => $row[1],            // Cột "Đơn vị tính"
                'dongia' => (int)$row[2],           // Cột "Đơn giá (VND)"
                'soluong' => (int)$row[3],          // Cột "Số lượng"
                'ghichu' => $row[4] ?? null,        // Cột "Ghi chú"
            ];
        }

        // Chèn dữ liệu vào bảng
        DB::table('thuoc')->insert($thuoc);
    }
}
