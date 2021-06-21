<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = ['name','untuk','program_id'];
    protected $dates = ['deleted_at'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
