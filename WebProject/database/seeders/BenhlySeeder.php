<?php

namespace Database\Seeders;

use App\Models\Benhly;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class BenhLySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $filePath = base_path('database/seeders/data/Danh_sach_benh_ly.xlsx');

        // Đọc file Excel
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Lấy dữ liệu từ sheet
        $rows = $worksheet->toArray();

        // Bỏ qua hàng đầu tiên nếu là tiêu đề
        $benhly = [];
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue; // Bỏ qua tiêu đề
            }

            $benhly[] = [
                'tenbl' => $row[0],             // Cột "Tên bệnh lý"
            ];
        }

        // Chèn dữ liệu vào bảng
        DB::table('benhly')->insert($benhly);
    }
}
