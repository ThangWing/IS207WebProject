<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ctba extends Model
{
    //
    use HasFactory;

    protected $table = 'ctba';
    public $incrementing = false;
    public $timestamps = false; // Nếu bảng không có cột timestamps (created_at và updated_at)

    protected $primaryKey = ['maba', 'mabl'];

    protected $keyType = 'int';

    protected $fillable = [
        'maba',
        'mabl',
    ];

    public function hsba()
    {
        return $this->belongsTo(Hsba::class, 'maba');
    }

    public function benhly()
    {
        return $this->belongsTo(Benhly::class, 'mabl');
    }
}
