<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phongxetnghiem extends Model
{
    //
    // use HasFactory;

    protected $table = 'phongxetnghiem';

    protected $primaryKey = 'mapxn';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'macls',
        'vitri',
    ];

    public $timestamps = false;

    public function canls()
    {
        return $this->belongsTo(canlamsang::class, 'macls', 'macls');
    }
}
