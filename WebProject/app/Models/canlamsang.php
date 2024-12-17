<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class canlamsang extends Model
{
    //
    // use HasFactory;

    protected $table = 'canls';

    protected $primaryKey = 'macls';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'tencls',
        'gia',
    ];

    public $timestamps = false;
}
