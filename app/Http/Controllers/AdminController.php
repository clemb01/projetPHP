<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\CommentaireViewModel;

class AdminController extends BaseController
{
    public function getAccueilAdmin()
    {
        return view('admin');
    }

    public function getPendingCommentaire(Request $request)
    {
        $query = "SELECT commentaire.*, user.login, note.note
                    FROM commentaire
                    LEFT OUTER JOIN user
                    ON commentaire.fk_user_id = user.id
                    LEFT OUTER JOIN note
                    ON commentaire.film_id = note.film_id
                    WHERE valide = 0";

        $params = array();

        if($request->get('userName') !== '')
        {
            $user = $request->get('userName');
            $query .= " AND user.login LIKE '%$user%'";
            //array_push($params, "'%".$request->get('userName')."%'");
        }

        if($request->get('movieName') !== '')
        {
            $movie = $request->get('movieName');
            $query .= " AND commentaire.Film_titre LIKE '%$$movie%'";
            //array_push($params, "'%$movie%'"); // Ne fonctionne pas comme ça aucune idée de pourquoi
        }

        return var_dump($query);

        $results = DB::select($query, $params);
        $model = array();

        if(count($results) > 0)
        {
            foreach($results as $result)
            {
                array_push($model, new CommentaireViewModel($result));
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