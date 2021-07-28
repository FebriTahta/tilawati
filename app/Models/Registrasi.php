<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'program_id',
        'name',
        'jenis'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function filepeserta()
    {
        return $this->hasMany(Filepeserta::class);
    }
}
