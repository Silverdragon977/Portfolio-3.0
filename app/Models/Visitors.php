<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    protected $fillable = [
        'ip',
        'country', 
        'country_code', 
        'region_name', 
        'region_code', 
        'city_name', 
        'zip_code', 
        'latitude', 
        'longitude', 
        'area_code', 
        'time_zone'
        ];

}
