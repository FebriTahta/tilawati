<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;
    protected $fillable = [
        'peserta_id',
        'data',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
