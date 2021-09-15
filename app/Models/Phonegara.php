<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonegara extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'negara_id',
        'country_name',
        'phonecode',
      ];
  
      public function negara()
      {
          return $this->belongsTo(Negara::class);
      }

      public function peserta()
      {
          return $this->hasMany(Peserta::class);
      }
}
