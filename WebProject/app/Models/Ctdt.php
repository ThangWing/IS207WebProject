<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctdt extends Model
{
    //
    use HasFactory;

    protected $table = 'ctdt';
    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = ['madt', 'mathuoc'];

    protected $keyType = 'int';

    protected $fillable = [
        'madt',
        'mathuoc',
        'soluong',
    ];

    public function donthuoc()
    {
        return $this->belongsTo(Donthuoc::class, 'madt');
    }

    public function thuoc()
    {
        return $this->belongsTo(Thuoc::class, 'mathuoc');
    }
}
