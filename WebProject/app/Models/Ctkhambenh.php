<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctkhambenh extends Model
{
    //
    use HasFactory, Compoships;

    protected $table = 'ctkhambenh';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['mabn', 'mapk'];

    public function benhnhan()
    {
        return $this->belongsTo(BenhNhan::class, ['mabn'], ['mabn']);
    }

    public function phongkham()
    {
        return $this->belongsTo(PhongKham::class, ['mapk'], ['mapk']);
    }
}
