<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donthuoc extends Model
{
    //
    // use HasFactory;
    public $timestamps = false;

    protected $table = 'donthuoc';
    protected $primaryKey = 'madt';

    protected $fillable = [
        'ghichu',
        'maba',
    ];

    public function hsba()
    {
        return $this->belongsTo(Hsba::class, 'maba');
    }

    public function ctdt()
    {
        return $this->hasMany(Ctdt::class, 'madt');
    }
}
