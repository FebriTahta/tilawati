<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country_data';
    protected $fillable = [
        'id_country',
        'country_name',
        'code1',
        'code2',
        'flag',
    ];
}
