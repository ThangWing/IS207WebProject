<?php

namespace Database\Seeders;

use App\Models\canlamsang;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class ClsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $filePath = base_path('database/seeders/data/Danh_sach_can_lam_sang.xlsx');

        // Đọc file Excel
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();

        // Lấy dữ liệu từ sheet
        $rows = $worksheet->toArray();

        // Bỏ qua hàng đầu tiên nếu là tiêu đề
        $cls = [];
        foreach ($rows as $index => $row) {
            if ($index === 0) {
                continue; // Bỏ qua tiêu đề
            }

            $cls[] = [
                'tencls' => $row[0],      
                'gia' => (int)$row[1],            
            ];
        }

        // Chèn dữ liệu vào bảng
        DB::table('canls')->insert($cls);
    }
}
