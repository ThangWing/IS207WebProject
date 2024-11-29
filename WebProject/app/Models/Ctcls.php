<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctcls extends Model
{
    //
    use HasFactory;

    protected $table = 'ctcls';

    public $timestamps = false;

    protected $primaryKey = ['maba', 'mapcn'];

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'maba',
        'mapcn',
        'ketqua',
    ];

    public function hsba()
    {
        return $this->belongsTo(Hsba::class, 'maba');
    }

    public function phongChucNang()
    {
        return $this->belongsTo(PhongChucNang::class, 'mapcn', 'mapcn');
    }
}
