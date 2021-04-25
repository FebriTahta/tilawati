<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    use HasFactory;
    protected $fillable =[
        'cabang_id',
        'jenis_id',
        'propinsi_id',
        'kota_id',
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
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
