<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctnhapvien extends Model
{
    //
    // use HasFactory;

    protected $table = 'nhapvien';

    protected $primaryKey = ['maba', 'mapb'];

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'maba',
        'mapb',
        'ngnv',
        'ngxv',
    ];

    public function hsba()
    {
        return $this->belongsTo(Hsba::class, 'maba');
    }

    public function phongBenh()
    {
        return $this->belongsTo(phongbenh::class, 'mapb');
    }
}
