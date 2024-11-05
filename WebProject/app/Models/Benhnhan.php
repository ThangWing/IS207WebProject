<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benhnhan extends Model
{
    //
    use HasFactory;

    protected $table = 'benhnhan';

    protected $primaryKey = 'mabn';

    protected $fillable = [
        'tenbn',
        'ngsinh',
        'gioitinh',
        'sdt',
        'diachi',
        'ghichu'
    ];

    public function hsbas()
    {
        return $this->hasMany(Hsba::class, 'mabn');
    }
}
