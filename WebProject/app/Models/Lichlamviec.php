<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lichlamviec extends Model
{
    protected $table = 'lichlamviec'; 
    // Bảng tương ứng
    protected $primaryKey = ['mabs', 'mapk', 'ngaylamviec', 'calamviec'];
    // Khóa chính phức hợp
    public $incrementing = false; 
    // Kiểu dữ liệu của khóa chính
    protected $fillable = ['mabs', 'mapk', 'ngaylamviec', 'calamviec'];

    public $timestamps = false;

    // Quan hệ với bảng BacSi
    public function bacsi()
    {
        return $this->belongsTo(Bacsi::class, 'mabs');
    }

    // Quan hệ với bảng PhongKham
    public function phongkham()
    {
        return $this->belongsTo(phongkham::class, 'mapk');
    }
}
