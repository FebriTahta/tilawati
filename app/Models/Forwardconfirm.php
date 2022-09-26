<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forwardconfirm extends Model
{
    use HasFactory;
    protected $fillable = [
        'cabang_id','pelatihan_id','untuk'
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }

    public function untuk()
    {
        return $this->belongsTo(Cabang::class);
    }
}
