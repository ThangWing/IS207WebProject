<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhanvien extends Models
{
    use HasFactory;

    // Tên bảng trong cơ sở dữ liệu
    protected $table = 'nhanvien';

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

    // Mối quan hệ với bảng Phongban
    public function phongban()
    {
        return $this->belongsTo(Phongban::class, 'maphongban', 'id');
    }

    // Mối quan hệ với bảng Congviec (nếu có nhiều công việc)
    public function congviec()
    {
        return $this->hasMany(Congviec::class, 'manhanvien', 'id');
    }
}
