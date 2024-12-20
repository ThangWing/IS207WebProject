<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benhnhan extends Model
{
    protected $table = 'benhnhan';

    protected $primaryKey = 'mabn';

    protected $fillable = [
        'tenbn',
        'ngsinh',
        'gioitinh',
        'sdt',
        'cccd',
        'diachi',
        'ghichu'
    ];

    public function hsba()
    {
        return $this->hasMany(Hsba::class, 'mabn');
    }

    public function bhyt()
    {
        return $this->hasOne(Bhyt::class, 'mabn');
    }
}
