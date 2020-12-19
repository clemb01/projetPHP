<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\CommentaireViewModel;

class AdminController extends BaseController
{
    public function CommentairesView(Request $request)
    {
        if(empty($_SESSION['user']) || $_SESSION['user']->getRole() !== "Admin")
        {
            return new Response("<h1>Unauthorized</h1>", 403);
        }

        return view('commentairesAdmin');
    }

    public function UsersView(Request $request)
    {
        if(empty($_SESSION['user']) || $_SESSION['user']->getRole() !== "Admin")
        {
            return new Response("<h1>Unauthorized</h1>", 403);
        }

        return view('usersAdmin');
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
            $query .= " AND commentaire.Film_titre LIKE '%$movie%'";
            //array_push($params, "'%$movie%'"); // Ne fonctionne pas comme ça aucune idée de pourquoi
        }

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
        DB::delete("DELETE FROM commentaire WHERE id = ?", [$request->get('commentaireId')]);

        return redirect('/admin');
    }

    public function acceptUserCommentaire(Request $request)
    {     
        DB::update("UPDATE commentaire SET valide = 1 WHERE id = ?", [$request->get('commentaireId')]);

        return redirect('/admin');
    }
}