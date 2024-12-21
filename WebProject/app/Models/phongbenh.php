<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phongbenh extends Model
{
    //
    // use HasFactory;

    protected $table = 'phongbenh';

    protected $primaryKey = 'mapb';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'tenphong',
        'vitri',
        'loaidv',
        'makhoa',
    ];

    public $timestamps = false;

    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'makhoa', 'makhoa');
    }
}
