<?php

return [

    /**
     * Get a free Open Weather Map API key : https://openweathermap.org/price.
     *
     */

    'api_key' => '97172a576a081ec6f9f05b803522070f', // get an API key

    /**
     * Library https://openweathermap.org/current#multi
     *
     */

    'lang' => 'en',

    // 'date_format' => 'm/d/Y',
    'date_format' => 'Y-m-d',
    'time_format' => 'h:i A',
    'day_format' => 'l',

    /**
     * Units: available units are c, f, k. (k is default)
     *
     * For temperature in Fahrenheit (f) and wind speed in miles/hour, use units=imperial
     * For temperature in Celsius (c) and wind speed in meter/sec, use units=metric
     */

    'temp_format' => 'c',
];
