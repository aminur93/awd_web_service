<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultivationSection extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts =[
        'details'=>'json'
    ];
    

    public function crop()
    {
        return $this->belongsTo(Crop::class, 'crop_id', 'id');
    }

    public function cultivationCategory()
    {
        return $this->belongsTo(CultivationCategory::class, 'category_id', 'id');
    }

    function cultivationseason()
    {
        return $this->hasMany(CultivationSeason::class);
    }
}
