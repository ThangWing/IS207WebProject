<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bhyt extends Model
{
    //
    protected $table = 'bhyt';

    protected $primaryKey = 'bhytid';

    protected $fillable = [
        'mabn',
        'ma_the',
        'doituong',
        'ngay_hieu_luc',
        'ngay_het_han',
        'noi_dang_ky',
    ];

    // Quan hệ với bảng benhnhan
    public function benhnhan()
    {
        return $this->belongsTo(Benhnhan::class, 'mabn', 'mabn');
    }
}
