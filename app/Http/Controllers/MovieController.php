<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class MovieController extends BaseController
{  
    public function getFilms(Request $request)
    {    
        $baseAPIUrl = "https://api.themoviedb.org/3";
        $apiKey = "92db563e1ec1286dac46e4ee14889fcf";

        $page = $request->get('page');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$baseAPIUrl/discover/movie?api_key=$apiKey&language=fr-FR&sort_by=popularity.desc&page=$page",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if(!$response)
        {
            return view('greeting', ['response' => $err]);
        }

        $result = json_decode($response);
        
        return view('accueil', ['model' => $result]);
    }
}