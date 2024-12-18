<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class thuoc extends Model
{
    protected $table = 'thuoc';

    protected $primaryKey = 'mathuoc';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'tenthuoc',
        'soluong',
        'donvi',
        'dongia',
        'ghichu',
    ];

    public $timestamps = false;
}
