<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = 'hoadon';

    protected $primaryKey = 'mahd';
    
    public $incrementing = true;

    protected $fillable = [
        'maba',
        'tong_tien',
        'ghi_chu',
        'trang_thai',
        'thoi_gian_tao'
    ];

    protected $dates = [
        'thoi_gian_tao',
        'created_at',
        'updated_at'
    ];

    // Relationship với HSBA
    public function hsba()
    {
        return $this->belongsTo(HSBA::class, 'hsba_id', 'id');
    }

    // Tính tổng tiền từ CTCLS và đơn thuốc
    public function tinhTongTien()
    {
        $tongTienCLS = $this->hsba->ctcls()->sum('gia');
        
        $tongTienThuoc = $this->hsba->ctdts()
            ->join('thuoc', 'ctdt.thuoc_id', '=', 'thuoc.id')
            ->selectRaw('SUM(ctdt.so_luong * thuoc.gia) as tong')
            ->value('tong');

            $tongTienNhapVien = $this->hsba->nhapvien()
            ->join('phongbenh', 'nhapvien.phong_id', '=', 'phongbenh.mapb')
            ->selectRaw("
                SUM(
                    CASE
                        WHEN phongbenh.loaidv = 'VIP' THEN TIMESTAMPDIFF(DAY, nhapvien.ngnv, nhapvien.ngxv) * 1000000
                        WHEN phongbenh.loaidv = 'Bình thường' THEN TIMESTAMPDIFF(DAY, nhapvien.ngnv, nhapvien.ngxv) * 500000
                        ELSE 0
                    END
                ) as tong")
            ->value('tong');

        return $tongTienCLS + $tongTienThuoc + $tongtienNhapVien + 100000;
    }
}