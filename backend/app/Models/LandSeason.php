<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandSeason extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'land_season';

    function prepration()
    {
        //One user_instrument belongs to one instrument 
        return $this->belongsTo(LandPrepration::class, 'land_prepration_id', 'id');
    }

    function landpreprationseasion()
    {
        //One user_instrument belongs to one level
        return $this->belongsTo(LandPreprationSeasion::class, 'season_id','id');
    }
}
