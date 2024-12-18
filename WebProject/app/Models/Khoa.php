<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    //
    // use HasFactory;

    protected $table = 'khoa';

    protected $primaryKey = 'makhoa';

    protected $fillable = [
        'tenkhoa',
        'trgkhoa',
    ];
}
