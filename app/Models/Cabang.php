<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'status',
        // 'kepala',
        'province_id',
        'city_id',
        'kecamatan',
        'teritorial'
        // 'alamat',
        // 'pos',
        // 'telp',
        // 'email',
        // 'ekspedisi',
        // 'jabatan'
    ];
    protected $dates = ['deleted_at'];

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class);
    }

    public function lembaga()
    {
        return $this->hasMany(Lembaga::class);
    }

    public function pelatihan()
    {
        return $this->hasMany(Pelatihan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
