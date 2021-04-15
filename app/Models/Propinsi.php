<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propinsi extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
    ];

    public function kota()
    {
        return $this->hasMany(Kota::class);
    }

    public function cabang()
    {
        return $this->hasMany(Cabang::class);
    }
}
