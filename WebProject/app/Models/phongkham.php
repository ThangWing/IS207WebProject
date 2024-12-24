<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phongkham extends Model
{
    protected $table = 'phongkham';

    protected $primaryKey = 'mapk';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'tenphong',
        'vitri', 
        'makhoa',
    ];

    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'makhoa');
    }

    public function ctkhambenh()
    {
        return $this->hasMany(Ctkhambenh::class, 'mapk');
    }

    public function lichlamviec()
    {
        return $this->hasMany(Lichlamviec::class, 'mapk');
    }
}

