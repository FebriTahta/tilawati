<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'peserta_id',
        'no',
        'link',
    ];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
