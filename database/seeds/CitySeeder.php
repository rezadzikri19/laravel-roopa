<?php

use App\City;
use App\RajaOngkir\RajaOngkir;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = (new RajaOngkir)->allCity()->get();
        foreach ($cities as $city) {
            if($city['type']=='Kabupaten'){
                City::create([
                    'city_id' => $city['city_id'],
                    'city' => 'Kabupaten ' . $city['city_name'],
                    'province_id' => $city['province_id']
                ]);
            }
            else {
                City::create([
                'city_id' => $city['city_id'],
                'city' => 'Kota ' . $city['city_name'],
                'province_id' => $city['province_id']
                ]);            
            }
        }
    }
}