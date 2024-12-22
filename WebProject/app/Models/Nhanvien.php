<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhanvien extends Models
{
    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'nhanvien';

    public $incrementing = true;

    protected $primaryKey = 'manv';

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'tennv',      // Tên nhân viên
        'ngsinh',     // Ngày sinh
        'gioitinh',   // Giới tính
        'diachi',     // Địa chỉ
        'sdt',        // Số điện thoại
        'email',      // Email
        'chucvu',     // Chức vụ
        'maphongban'  // Mã phòng ban
    ];
}
