<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hsba extends Model
{
    //
    use HasFactory;

    protected $table = 'hsba';

    protected $fillable = [
        'mabn',
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
    public function ctnhapvien()
    {
        return $this->hasMany(Ctnhapvien::class, 'maba');
    }

    // Quan hệ với bệnh nhân
    public function benhnhan()
    {
        return $this->belongsTo(Benhnhan::class, 'mabn');
    }
}
