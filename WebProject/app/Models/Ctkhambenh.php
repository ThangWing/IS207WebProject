<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctkhambenh extends Model
{
    protected $table = 'ctkhambenh';

    protected $primaryKey = 'makb'; // Đặt khóa chính là makb
    public $incrementing = true; // Sử dụng tự tăng
    protected $keyType = 'int'; // Kiểu dữ liệu int

    public $timestamps = true; // Bật timestamps

    protected $fillable = [
        'mabn',
        'mapk',
        'created_at',
    ];

    public function getNgayKham()
    {
        return $this->created_at;
    }

    public function benhnhan()
    {
        return $this->belongsTo(Benhnhan::class, 'mabn');
    }

    public function phongkham()
    {
        return $this->belongsTo(phongkham::class, 'mapk');
    }
}
