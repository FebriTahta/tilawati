<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug'];
    protected $dates = ['deleted_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function registrasi()
    {
        return $this->hasMany(Registrasi::class);
    }

    public function pelatihan()
    {
        return $this->hasMany(Pelatihan::class);
    }

    public function penilaian()
    {
        return $this->hasmany(Penilaian::class);
    }

    public function kriteria()
    {
        return $this->hasMany(Kriteria::class);
    }
}
