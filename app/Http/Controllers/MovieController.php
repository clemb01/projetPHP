<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\SearchViewModel;
use App\Models\MovieViewModel;

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

        if (!$response) {
            return view('accueil', ['response' => $err]);
        }

        $result = json_decode($response);

        $model = new SearchViewModel($result);

        return view('accueil', ['model' => $model]);
    }

    public function getFilm($id)
    {
        $model = new MovieViewModel();

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

        if (!$response) {
            return view('movie', ['model' => $err]);
        }

        $model->setMovie(json_decode($response));

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->baseAPIUrl/movie/$id/videos?api_key=$this->apiKey&language=fr-FR",
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

        if ($response) {
            $model->setTrailer(json_decode($response));
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->baseAPIUrl/movie/$id/credits?api_key=$this->apiKey&language=fr-FR",
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

        if ($response) {
            $model->setCast(json_decode($response));
        }

        return view('movie', ['model' => $model]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $page = $request->get('page') ? $request->get('page') : 1;

        $query = trim($query);

        $editedQuery = str_replace(" ", "+", $query);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->baseAPIUrl/search/movie?api_key=$this->apiKey&language=fr-FR&query=$editedQuery&page=$page&include_adult=false",
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

        if (!$response) {
            return view('movie', ['model' => $err]);
        }

        $result = json_decode($response);

        $model = new SearchViewModel($result);
        $model->setQuery($query);

        return view('search', ['model' => $model]);
    }

    public function advancedSearch(Request $request)
    {
        $query = $request->get('query');
        $page = $request->get('page') ? $request->get('page') : 1;
        $annee = $request->get('annee') ?? null;

        $query = trim($query);

        $editedQuery = str_replace(" ", "+", $query);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$this->baseAPIUrl/search/movie?api_key=$this->apiKey&language=fr-FR&query=$editedQuery&page=$page&include_adult=false" . $annee ?? '',
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

        if (!$response) {
            return view('movie', ['model' => $err]);
        }

        $result = json_decode($response);

        $model = new SearchViewModel($result);
        $model->setQuery($query);

        return view('search', ['model' => $model]);
    }
}
