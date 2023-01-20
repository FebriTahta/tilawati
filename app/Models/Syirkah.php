<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syirkah extends Model
{
    use HasFactory;

    protected $fillable = [
        'cabang_id',
        'syirkah_dc',
        'ekstensi'
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
