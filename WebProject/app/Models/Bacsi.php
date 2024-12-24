<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bacsi extends Model
{
    //
    // use HasFactory;

    protected $table = 'bacsi';
    protected $primaryKey = 'mabs';

    protected $fillable = [
        'tenbs',
        'ngsinh',
        'gioitinh',
        'diachi',
        'sdt',
        'email',
        'hocvi',
        'chucvu',
        'makhoa'
    ];

    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'makhoa');
    }

    public function lichlamviec()
    {
        return $this->hasMany(Lichlamviec::class, 'mabs', 'mabs');
    }
}
