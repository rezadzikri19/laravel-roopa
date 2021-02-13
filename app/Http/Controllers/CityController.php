<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCities($province_id){

        $city = City::where('province_id', $province_id)->pluck('city', 'city_id');
        return json_encode($city);
    }
}