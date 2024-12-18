<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lichlamviec extends Model
{
    //
    protected $table = 'lichlamviec';

    // Tắt auto-increment vì không có cột khóa chính tự động tăng
    public $incrementing = false;

    // Kiểu dữ liệu của khóa chính
    protected $keyType = 'string';

    // Các cột có thể được gán giá trị
    protected $fillable = [
        'mabs',
        'mapk',
        'ngaylamviec',
        'calamviec',
    ];

    // Quan hệ với bảng BacSi
    public function bacSi()
    {
        return $this->belongsTo(Bacsi::class, 'mabs', 'mabs');
    }

    // Quan hệ với bảng PhongKham
    public function phongKham()
    {
        return $this->belongsTo(phongkham::class, 'mapk', 'mapk');
    }
}
