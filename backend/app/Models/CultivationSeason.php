<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultivationSeason extends Model
{
    use HasFactory;

    protected $table = 'cultivation_season';

    function cultivation()
    {
        //One user_instrument belongs to one instrument 
        return $this->belongsTo(CultivationSection::class, 'cultivation_section_id', 'id');
    }

    function cultivationpreprationseasion()
    {
        //One user_instrument belongs to one level
        return $this->belongsTo(LandPreprationSeasion::class, 'seasion_id','id');
    }
}
