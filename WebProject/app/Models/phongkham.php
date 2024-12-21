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
        'tenkhoa',
        'vitri', 
        'makhoa'
    ];

    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'makhoa', 'makhoa');
    }

    public function ctkhambenh()
    {
        return $this->hasMany(CtKhamBenh::class, 'mapk', 'mapk');
    }

    public function lichlamviec()
    {
        return $this->hasMany(Lichlamviec::class, 'mapk', 'mapk');
    }
}

