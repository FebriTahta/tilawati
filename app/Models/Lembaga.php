<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'cabang_id',
        'name',
        'alamat',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'jml_guru',
        'jml_santri',
        'pos',
        'telp',
        'website',
        'pengelola',
        'jenjang_id',
        'tahunberdiri',
        'tahunmasuk',
        'status'
    ];
    protected $dates = ['deleted_at'];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jenjang()
    {
        return $this->belongsTo(Jenjang::class);
    }

    public function kepala()
    {
        return $this->belongsTo(Kepala::class);
    }

    public function peserta()
    {
        return $this->hasMany(Peserta::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
