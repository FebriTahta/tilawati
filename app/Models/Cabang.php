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
        'kode',
        'kepala_id',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'alamat',
        'pos',
        'telp',
        'ekspedisi',
        'teritorial'
    ];
    protected $dates = ['deleted_at'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
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

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kepala()
    {
        return $this->belongsTo(Kepala::class);
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }

    public function induksertifikat()
    {
        return $this->hasMany(Induksertifikat::class);
    }
}
