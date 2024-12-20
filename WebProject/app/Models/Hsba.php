<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hsba extends Model
{
    //
    // use HasFactory;

    protected $table = 'hsba';
    protected $primaryKey = 'maba';

    protected $fillable = [
        'nhapvien',
        'ghichu'
    ];

    // Quan hệ với bảng `ctba`
    public function ctba()
    {
        return $this->hasMany(Ctba::class, 'maba');
    }

    // Quan hệ với bảng `donthuoc`
    public function donthuoc()
    {
        return $this->hasMany(Donthuoc::class, 'maba');
    }

    // Quan hệ với bảng `ctcls`
    public function ctcls()
    {
        return $this->hasMany(Ctcls::class, 'maba');
    }

    // Quan hệ với bảng `ctnhapvien`
    public function nhapvien()
    {
        return $this->hasMany(Ctnhapvien::class, 'maba');
    }

    // Quan hệ với bệnh nhân
    public function benhnhan()
    {
        return $this->belongsTo(Benhnhan::class, 'mabn');
    }

    public function ctdts()
    {
        return $this->hasManyThrough(
            Ctdt::class,    // Model cuối (Chi tiết đơn thuốc)
            Donthuoc::class, // Model trung gian (Đơn thuốc)
            'maba',       // Khóa ngoại trong bảng DonThuoc (HSBA -> DonThuoc)
            'madt',   // Khóa ngoại trong bảng CTDT (DonThuoc -> CTDT)
            'maba',            // Khóa chính của bảng HSBA
            'madt'             // Khóa chính của bảng DonThuoc
        );
    }
}
