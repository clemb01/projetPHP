<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class MovieController extends BaseController
{  
    private $baseAPIUrl = "https://api.themoviedb.org/3";
    private $apiKey = "92db563e1ec1286dac46e4ee14889fcf";

    public function getFilms(Request $request)
    {
        $page = $request->get('page');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->baseAPIUrl/discover/movie?api_key=$this->apiKey&language=fr-FR&sort_by=popularity.desc&page=$page",
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
            return view('accueil', ['response' => $err]);
        }

        $result = json_decode($response);
        
        return view('accueil', ['model' => $result]);
    }

    public function getFilm($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->baseAPIUrl/movie/$id?api_key=$this->apiKey&language=fr-FR",
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
            return view('movie', ['model' => $err]);
        }

        $result = json_decode($response);
        
        return view('movie', ['model' => $result]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $page = $request->get('page') ? $request->get('page') : 1;

        $model = new SearchModel();
        $query = trim($query);
        $model->setQuery($query);

        $query = str_replace(" ", "+", $query);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->baseAPIUrl/search/movie?api_key=$this->apiKey&language=fr-FR&query=$query&page=$page&include_adult=false",
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
            return view('movie', ['model' => $err]);
        }

        $result = json_decode($response);

        $model->setResult($result);

        return view('search', ['model' => $model]);
    }
    /*
    public function getSearch(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$baseAPIUrl/search/movie?api_key=$apiKey&language=en-US&query=$query&page=$page&include_adult=false",
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
            return view('movie', ['model' => $err]);
        }

        $result = json_decode($response);
        
        return view('movie', ['model' => $result]);
    }*/
}

class SearchModel
{
    private $query;
    private $result;

    public function getQuery()
    {
        return $this->query;
    }

    public function setQuery($value)
    {
        $this->query = $value;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($value)
    {
        $this->result = $value;
    }
}