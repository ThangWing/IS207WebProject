<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctnhapvien extends Model
{
    //
    use HasFactory;

    protected $table = 'ctnhapvien';
    public $timestamps = false;

    protected $fillable = [
        'maba',
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
