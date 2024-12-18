<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoadon extends Model
{
    // use HasFactory;

    protected $table = 'hoadon';
    protected $primaryKey = 'mahd';
    protected $fillable = ['maba', 'tongtien', 'ghichu', 'thanhtoan'];

    // Liên kết với bảng hồ sơ bệnh án (Hsba)
    public function benhan()
    {
        return $this->belongsTo(Hsba::class, 'maba', 'maba');
    }
}
