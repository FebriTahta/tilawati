<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'pelatihan_id',
        'cabang_id',
        'lembaga_id',
        'name',
        'tanggal',
        'email',
        'tmptlahir',
        'tgllahir',
        'alamat',
        'telp',
        'provinsi_id',
        'kabupaten_id',
        'kriteria_id',
        'kriteria',
        'bersyahadah',
        'kota',
        'status'

    ];
    protected $dates = ['deleted_at'];

    public function certificate()
    {
        return $this->hasMany(Certificate::class);
    }
    public function filepeserta()
    {
        return $this->hasMany(Filepeserta::class);
    }
    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class);
    }

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class);
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
