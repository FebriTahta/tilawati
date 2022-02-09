<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpa extends Model
{
    use HasFactory;
    protected $fillable = [
        'cabang_id',
        'name',
        'ketua',
        'wilayah',
        'telp'
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
