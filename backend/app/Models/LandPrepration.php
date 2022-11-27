<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandPrepration extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function crop()
    {
        return $this->belongsTo(Crop::class, 'crop_id', 'id');
    }

    function landseason()
    {
        return $this->hasMany(LandSeason::class);
    }
}
