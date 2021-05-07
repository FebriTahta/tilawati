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
        // 'status',
        // 'kepala',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        // 'teritorial',
        'alamat',
        'pos',
        'telp',
        // 'email',
        'ekspedisi',
        'teritorial'
    ];
    protected $dates = ['deleted_at'];

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
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

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function kepala()
    {
        return $this->hasOne(Kepala::class);
    }
}
