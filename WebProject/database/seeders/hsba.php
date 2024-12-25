<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HsbaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dữ liệu mẫu cho bảng Hsba
        $hsba = [
            [
                'benhly' => 'Cảm cúm',
                'mabn' => 1,
            ],
            [
                'benhly' => 'Viêm phổi',
                'mabn' => 2,
            ],
            [
                'benhly' => 'Đau đầu',
                'mabn' => 3,
            ],
            [
                'benhly' => 'Tiểu đường',
                'mabn' => 4,
            ],
            [
                'benhly' => 'Suy thận',
                'mabn' => 5,
            ],
            [
                'benhly' => 'Viêm gan B',
                'mabn' => 6,
            ],
            [
                'benhly' => 'Suy tim',
                'mabn' => 7,
            ],
            [
                'benhly' => 'Cao huyết áp',
                'mabn' => 8,
            ],
            [
                'benhly' => 'Dị ứng',
                'mabn' => 9,
            ],
            [
                'benhly' => 'Sốt rét',
                'mabn' => 10,
            ],
            [
                'benhly' => 'Loét dạ dày',
                'mabn' => 11,
            ],
            [
                'benhly' => 'Viêm khớp',
                'mabn' => 12,
            ],
            [
                'benhly' => 'Ung thư phổi',
                'mabn' => 13,
            ],
            [
                'benhly' => 'Viêm gan C',
                'mabn' => 14,
            ],
            [
                'benhly' => 'Viêm tụy',
                'mabn' => 15,
            ],
            [
                'benhly' => 'Nhiễm trùng đường tiết niệu',
                'mabn' => 16,
            ],
            [
                'benhly' => 'Viêm tai giữa',
                'mabn' => 17,
            ],
            [
                'benhly' => 'Viêm dạ dày',
                'mabn' => 18,
            ],
            [
                'benhly' => 'Thiếu máu',
                'mabn' => 19,
            ],
            [
                'benhly' => 'Sốt xuất huyết',
                'mabn' => 20,
            ],
        ];

        // Chèn dữ liệu vào bảng
        DB::table('hsbas')->insert($hsba);
    }
}
