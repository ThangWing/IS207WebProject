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
    public function canls()
    {
        return $this->hasManyThrough(
            Canls::class,    // Model cuối (Cận lâm sàng)
            Ctcls::class,    // Model trung gian (Chi tiết cận lâm sàng)
            'maba',          // Khóa ngoại trong bảng CTCLS (HSBA -> CTCLS)
            'macls',         // Khóa ngoại trong bảng Canls (CTCLS -> Canls)
            'maba',          // Khóa chính của bảng HSBA
            'macls'          // Khóa chính của bảng CTCLS
        );
    }

    public function thuoc()
    {
        return $this->hasManyThrough(
            Thuoc::class,      // Model cuối: Thuốc
            Ctdt::class,       // Model trung gian: CTDT
            'madt',            // Khóa ngoại trong bảng CTDT trỏ tới Donthuoc
            'mathuoc',         // Khóa ngoại trong bảng Thuoc trỏ tới CTDT
            'maba',            // Khóa chính trong bảng HSBA
            'madt'             // Khóa chính trong bảng Donthuoc
        );
    }
}
