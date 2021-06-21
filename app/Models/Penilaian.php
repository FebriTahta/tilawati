<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'name',
        'min',
        'max',
        'kategori'
    ];
    protected $dates = ['deleted_at'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
    
}
