<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepala extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'tmptlahir',
        'tgllahir',
        'alamat',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'telp',
        'gender',
        'pekerjaan',
        'pendidikanter',
        'tahunlulus'
    ];

    public function cabang()
    {
        return $this->hasMany(Cabang::class);
    }
    public function lembaga()
    {
        return $this->hasMany(Lembaga::class);
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
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
    public function pelatihan()
    {
        return $this->hasMany(Pelatihan::class);
    }
}
