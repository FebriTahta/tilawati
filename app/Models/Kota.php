<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'propinsi_id',
    ];

    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class);
    }

    public function cabang()
    {
        return $this->hasMany(Cabang::class);
    }
}
