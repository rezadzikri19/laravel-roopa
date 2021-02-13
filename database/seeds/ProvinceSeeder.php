<?php

use App\Province;
use App\RajaOngkir\RajaOngkir;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = (new RajaOngkir)->AllProvince()->get();
        foreach ($provinces as $province) {
            Province::create([
                'province_id' => $province['province_id'],
                'province' => $province['province']
            ]);
        }    
    }
}