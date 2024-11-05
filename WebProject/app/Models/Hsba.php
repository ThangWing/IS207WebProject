<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hsba extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'mabn',
        'nhapvien',
        'ghichu'
    ];

    // Liên kết với Patient model
    public function benhnhan()
    {
        return $this->belongsTo(Benhnhan::class, 'mabn');
    }
}
