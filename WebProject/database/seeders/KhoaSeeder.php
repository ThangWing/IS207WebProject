<?php

namespace Database\Seeders;

use App\Models\Khoa;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $khoa = [
            ['makhoa' => '1', 'tenkhoa' => 'Khoa khám bệnh'],
            ['makhoa' => '2', 'tenkhoa' => 'Khoa Hồi sức cấp cứu'],
            ['makhoa' => '3', 'tenkhoa' => 'Khoa Nội tổng hợp'],
            ['makhoa' => '4', 'tenkhoa' => 'Khoa Nội tim mạch'],
            ['makhoa' => '5', 'tenkhoa' => 'Khoa Nội tiêu hóa'],
            ['makhoa' => '6', 'tenkhoa' => 'Khoa Nội cơ – xương – khớp'],
            ['makhoa' => '7', 'tenkhoa' => 'Khoa Nội thận – tiết niệu'],
            ['makhoa' => '8', 'tenkhoa' => 'Khoa Nội tiết'],
            ['makhoa' => '9', 'tenkhoa' => 'Khoa Dị ứng'],
            ['makhoa' => '10', 'tenkhoa' => 'Khoa Huyến Học lâm sàng'],
            ['makhoa' => '11', 'tenkhoa' => 'Khoa Truyền nhiễm'],
            ['makhoa' => '12', 'tenkhoa' => 'Khoa Lao'],
            ['makhoa' => '13', 'tenkhoa' => 'Khoa Da Liễu'],
            ['makhoa' => '14', 'tenkhoa' => 'Khoa Thần kinh'],
            ['makhoa' => '15', 'tenkhoa' => 'Khoa Tâm thần'],
            ['makhoa' => '16', 'tenkhoa' => 'Khoa Y học cổ truyền'],
            ['makhoa' => '17', 'tenkhoa' => 'Khoa Lão học'],
            ['makhoa' => '18', 'tenkhoa' => 'Khoa Nhi'],
            ['makhoa' => '19', 'tenkhoa' => 'Khoa Ngoại tổng hợp'],
            ['makhoa' => '20', 'tenkhoa' => 'Khoa Ngoại thần kinh'],
            ['makhoa' => '21', 'tenkhoa' => 'Khoa Ngoại lồng ngực'],
            ['makhoa' => '22', 'tenkhoa' => 'Khoa Ngoại tiêu hóa'],
            ['makhoa' => '23', 'tenkhoa' => 'Khoa Ngoại thận – tiết niệu'],
            ['makhoa' => '24', 'tenkhoa' => 'Khoa Chấn thương chỉnh hình'],
            ['makhoa' => '25', 'tenkhoa' => 'Khoa Bỏng'],
            ['makhoa' => '26', 'tenkhoa' => 'Khoa Phẩu thuật gây mê hồi sức'],
            ['makhoa' => '27', 'tenkhoa' => 'Khoa Phụ sản'],
            ['makhoa' => '28', 'tenkhoa' => 'Khoa Tai – mũi – họng'],
            ['makhoa' => '29', 'tenkhoa' => 'Khoa Răng - hàm – mặt'],
            ['makhoa' => '30', 'tenkhoa' => 'Khoa mắt'],
            ['makhoa' => '31', 'tenkhoa' => 'Khoa Vật lý trị liệu – phục hồi chức năng'],
            ['makhoa' => '32', 'tenkhoa' => 'Khoa Y học hạt nhân'],
            ['makhoa' => '33', 'tenkhoa' => 'Khoa Truyền máu'],
            ['makhoa' => '35', 'tenkhoa' => 'Khoa Lọc máu (thận nhân tạo)'],
            ['makhoa' => '36', 'tenkhoa' => 'Khoa Huyến học'],
            ['makhoa' => '37', 'tenkhoa' => 'Khoa Hóa Sinh'],
            ['makhoa' => '38', 'tenkhoa' => 'Khoa Vi sinh'],
            ['makhoa' => '39', 'tenkhoa' => 'Khoa Chẩn đoán hình ảnh'],
            ['makhoa' => '40', 'tenkhoa' => 'Khoa Thăm dò chức năng'],
            ['makhoa' => '41', 'tenkhoa' => 'Khoa Nội soi'],
            ['makhoa' => '42', 'tenkhoa' => 'Khoa Giải phẫu bệnh'],
            ['makhoa' => '43', 'tenkhoa' => 'Khoa Chống nhiễm khuẩn'],
            ['makhoa' => '44', 'tenkhoa' => 'Khoa Dược'],
            ['makhoa' => '45', 'tenkhoa' => 'Khoa Dinh dưỡng'],
        ];

        DB::table('khoa')->insert($khoa);
    }
}
