<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RakibDevs\Weather\Weather;

class WeatherController extends Controller
{
    public function weatherForLocation($location){
        $wt = new Weather();
        $weatherApi = $wt->getCurrentByCity($location);

        $weatherDt = explode(' ',$weatherApi->dt);
        $date = $weatherDt[0];
        $time = $weatherDt[1].' '.$weatherDt[2];

        $weather['temp']        = $weatherApi->main->temp;
        $weather['temp_min']    = $weatherApi->main->temp_min;
        $weather['temp_max']    = $weatherApi->main->temp_max;
        $weather['sunrise']     = $weatherApi->sys->sunrise;
        $weather['sunset']      = $weatherApi->sys->sunset;
        $weather['location']    = $weatherApi->name;
        $weather['date']        = $date;
        $weather['time']        = $time;

        return response()->json($weather);
    }
}
