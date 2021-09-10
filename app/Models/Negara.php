<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    use HasFactory;
    protected $table = 'country_data';
    protected $fillable =[
      'id',
      'country_name',
      'code1',
      'code2',
      'flag' 
    ];

    public function phonegara()
    {
        return $this->hasOne(Phonegara::class);
    }
}
