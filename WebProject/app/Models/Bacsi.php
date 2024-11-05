<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bacsi extends Model
{
    //
    use HasFactory;

    protected $table = 'bacsi';

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
}
