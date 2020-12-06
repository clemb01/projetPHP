<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Commentaire;

class AdminController extends BaseController
{
    public function getAccueilAdmin()
    {
        return view('admin');
    }

    public function getPendingCommentaire(Request $request)
    {
        $query = "SELECT * FROM commentaire WHERE valide = 0";
        $params = array();

        if($request->get('userName') !== '')
        {
            $user = $request->get('userName');
            $query .= " AND fk_user_id LIKE '%$user%'";
            //array_push($params, "'%".$request->get('userName')."%'");
        }

        if($request->get('movieName') !== '')
        {
            $movie = $request->get('movieName');
            $query .= " AND film_id LIKE '%$movie%'";
            //array_push($params, "'%$movie%'"); // Ne fonctionne pas comme ça aucune idée de pourquoi
        }

        $results = DB::select($query, $params);
        $model = array();

        if(count($results) > 0)
        {
            foreach($results as $result)
            {
                array_push($model, new Commentaire($result));
            }
        }

        return view('partial.pendingCommentaire', ['model' => $model]);
    }

    public function refuseUserCommentaire(Request $request)
    {
        $userRate = DB::select("SELECT note FROM note WHERE film_id = ?", [$request->get('movieId')]);

        if(!$userRate)
            return view('partial.movieUserRate', ['movieId' => $request->get('movieId'), 'note' => -1]);

        return view('partial.movieUserRate', ['movieId' => $request->get('movieId'), 'note' => $userRate[0]->note]);
    }

    public function acceptUserCommentaire(Request $request)
    {
        $userRate = DB::select("SELECT note FROM note WHERE film_id = ?", [$request->get('movieId')]);

        if(!$userRate)
            return view('partial.movieUserRate', ['movieId' => $request->get('movieId'), 'note' => -1]);

        return view('partial.movieUserRate', ['movieId' => $request->get('movieId'), 'note' => $userRate[0]->note]);
    }
}