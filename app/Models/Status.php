<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $fillable = [
        'peserta_id',
        'stats',
    ];
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
