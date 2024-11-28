<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctnhapvien extends Model
{
    //
    use HasFactory;

    protected $table = 'nhapvien';

    protected $fillable = [
        'maphg',
        'ngnv',
        'ngxv',
        'loaidv',
    ];

    public function hsba()
    {
        return $this->belongsTo(Hsba::class, 'maba');
    }

    public function phong()
    {
        return $this->belongsTo(Phong::class, 'maphg');
    }
}
