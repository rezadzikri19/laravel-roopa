<?php

namespace App\RajaOngkir;

class RajaOngkir
{
    public $result;
    public $err;
    public $origin_id;
    public $destination_id;
    public $weight;
    public $couriers;

    public function allProvince(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: b2d3d38d01a094eaa2f5a2152add2deb"
        ),
        ));

        $responses = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $responses = json_decode($responses, true);
        $responses = $responses['rajaongkir']['results'];

        $this->result = $responses;
        $this->err = $err;

        return $this;
    }

    public function allCity(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=&province=",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: b2d3d38d01a094eaa2f5a2152add2deb"
        ),
        ));

        $responses = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $responses = json_decode($responses, true);
        $responses = $responses['rajaongkir']['results'];

        $this->result = $responses;
        $this->err = $err;

        return $this;
    }

    public function cost(){

        $couriers = $this->couriers;

        foreach ($couriers as $key => $courier) {
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$this->origin_id&destination=$this->destination_id&weight=$this->weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: b2d3d38d01a094eaa2f5a2152add2deb"
            ),
            ));
    
            $responses = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
    
            $responses = json_decode($responses, true);
            $responses = $responses['rajaongkir']['results'];
    
            $this->result[$key] = $responses;
            $this->err = $err;
        }
        return $this;
    }

    public function setOrigin($origin_id){
        $this->origin_id = $origin_id;
        
        return $this;
    }

    public function setDestination($destination_id){
        $this->destination_id = $destination_id;
        
        return $this;
    }

    public function setWeight($weight){
        $this->weight = $weight;
        
        return $this;
    }

    public function setCouriers(array $couriers){
        $this->couriers = $couriers;
        
        return $this;
    }

    public function get(){
        return $this->result;
    }
}