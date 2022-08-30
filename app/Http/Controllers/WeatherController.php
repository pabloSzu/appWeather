<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function consultarApi(){
        $location = $_POST['location'];

        $queryString = http_build_query([
          'access_key' => '92148faafe9093cec9c22987653f9910',
          'query' => $location,
        ]);
        
        $ch = curl_init(sprintf('%s?%s', 'http://api.weatherstack.com/current', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $json = curl_exec($ch);
        
        curl_close($ch);
        
        $api_result = json_decode($json, true);

        if(isset($api_result["success"])){
            $error = "No existe la ciudad";
            return view('home', compact('error'));
        }else{
            return view('home', compact('api_result'));
        }

    }
}
