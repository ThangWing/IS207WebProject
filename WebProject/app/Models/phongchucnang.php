<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phongchucnang extends Model
{
    //
    use HasFactory;

    protected $table = 'phongchucnang';

    protected $primaryKey = 'mapcn';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'macls',
        'vitri',
    ];

    public $timestamps = false;

    public function canls()
    {
        return $this->belongsTo(Canls::class, 'macls', 'macls');
    }
}
