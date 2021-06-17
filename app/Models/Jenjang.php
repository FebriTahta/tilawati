<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
    ];
    public function lembaga()
    {
        return $this->hasMany(Lembaga::class);
    }
}
