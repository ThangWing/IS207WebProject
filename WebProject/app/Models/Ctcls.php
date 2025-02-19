<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctcls extends Model
{
    //
    // use HasFactory;

    protected $table = 'ctcls';

    public $timestamps = false;

    protected $primaryKey = ['maba', 'macls'];

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'maba',
        'macls',
        'ketqua',
    ];

    public function hsba()
    {
        return $this->belongsTo(Hsba::class, 'maba');
    }

    public function canlamsang()
    {
        return $this->belongsTo(canlamsang::class, 'macls', 'macls');
    }
}
