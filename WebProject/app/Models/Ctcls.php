<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctcls extends Model
{
    //
    use HasFactory;

    protected $table = 'ctcls';
    public $timestamps = false;

    protected $fillable = [
        'macls',
        'ketqua',
    ];

    public function hsba()
    {
        return $this->belongsTo(Hsba::class, 'maba');
    }

    public function canls()
    {
        return $this->belongsTo(Canls::class, 'macls');
    }
}
