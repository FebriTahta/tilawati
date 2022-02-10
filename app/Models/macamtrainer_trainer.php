<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class macamtrainer_trainer extends Model
{
    use HasFactory;
    protected $table = 'macamtrainer_trainer';

    protected $fillable = [
        'macamtrainer_id',
        'trainer_id'
    ];

}
