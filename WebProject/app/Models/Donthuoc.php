<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donthuoc extends Model
{
    //
    use HasFactory;

    protected $table = 'donthuoc';

    protected $fillable = [
        'ghichu',
    ];

    public function hsba()
    {
        return $this->belongsTo(Hsba::class, 'maba');
    }

    public function ctdts()
    {
        return $this->hasMany(Ctdt::class, 'madt');
    }
}
