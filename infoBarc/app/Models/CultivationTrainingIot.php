<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultivationTrainingIot extends Model
{
    use HasFactory;

    protected $table = 'cultivation_training_iot';

    protected $guarded = [];

    protected $casts =[
        'details'=>'json'
    ];
}
