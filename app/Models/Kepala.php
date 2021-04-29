<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepala extends Model
{
    use HasFactory;
    protected $table = 'kepalas';

    protected $fillable = [
        'name',
        'tmptlahir',
        'tgllahir',
        'alamat',
        'provinsi_id',
        'kota_id',
        'kecamatan_id',
        'kelurahan_id',
        'telp',
        'gender',
        'pekerjaan'
    ];

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
}
