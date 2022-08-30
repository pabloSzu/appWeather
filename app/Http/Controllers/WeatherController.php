<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WeatherController extends Controller
{
    public function consultarApi(){
        $location = $_POST['location'];

        $ciudades = DB::select('SELECT * FROM ciudad WHERE nombre LIKE ?', [$location]);

        //Si existe el nombre de la ciudad, lo busco de la base de datos
        if(isset($ciudades[0]->nombre) ){

            $consulta_ciudad['location']['name'] = $ciudades[0]->nombre;
            $consulta_ciudad['current']['temperature'] = $ciudades[0]->temperatura;
            $consulta_ciudad['current']['weather_icons'][0] = $ciudades[0]->imagen;

            return view('home', compact('consulta_ciudad'));
        }



        //Si no existe consulto la API
        $queryString = http_build_query([
          'access_key' => '92148faafe9093cec9c22987653f9910',
          'query' => $location,
        ]);
        
        $ch = curl_init(sprintf('%s?%s', 'http://api.weatherstack.com/current', $queryString));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $consulta_ciudad = json_decode($json, true);

        //si no existe el nombre buscado retorno alerta
        if(isset($consulta_ciudad["success"])){
            return back()->with('mensaje', 'No se encuentra la ciudad buscada. Intente nuevamente');
        //si existe le nombre buscado la agrego a la DB y la muestro
        }else{

            DB::table('ciudad')->insert([
                'nombre' =>  $consulta_ciudad['location']['name'],
                'temperatura' =>  $consulta_ciudad['current']['temperature'],
                'imagen' =>  $consulta_ciudad['current']['weather_icons'][0],

            ]);

            return view('home', compact('consulta_ciudad'));
        }

    }
}
