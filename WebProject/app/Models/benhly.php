<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class benhly extends Model
{
    protected $table = 'benhly';

    protected $primaryKey = 'mabl';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'tenbl',
    ];

    public $timestamps = false;
}
