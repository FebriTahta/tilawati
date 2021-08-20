<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'acara_id',
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
        'kecamatan_id',
        'kelurahan_id',
        'kriteria_id',
        'kriteria',
        'bersyahadah',
        'kota',
        'status'

    ];
    protected $dates = ['deleted_at'];

    public function acara()
    {
        return $this->hasMany(Acara::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
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

    public function donatur()
    {
        return $this->hasOne(Donatur::class);
    }

    public function status()
    {
        return $this->hasOne(Status::class);
    }
}
