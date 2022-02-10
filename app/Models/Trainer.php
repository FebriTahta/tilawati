<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'cabang_id',
        'name',
        'alamat',
        'telp',
        'trainer',
        'status'
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function macamtrainer()
    {
        return $this->belongsToMany(Macamtrainer::class);
    }
}
