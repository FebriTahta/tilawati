<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penguruscabang extends Model
{
    use HasFactory;
    protected $fillable = [
        'cabang_id',
        'bagian',
        'nama_pengurus',
        'telp_pengurus',
    ];
}
