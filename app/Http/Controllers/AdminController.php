<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\CommentaireViewModel;
use App\Models\User;
use App\Models\GestionUserViewModel;

class AdminController extends BaseController
{
    public function CommentairesView(Request $request)
    {
        if(empty($_SESSION['user']) || $_SESSION['user']->getRole() !== "admin")
        {
            return redirect('/accueil');
        }

        return view('commentairesAdmin');
    }

    public function UsersView(Request $request)
    {
        if(empty($_SESSION['user']) || $_SESSION['user']->getRole() !== "admin")
        {
            return redirect('/accueil');
        }

        return view('usersAdmin');
    }

    public function getUsers(Request $request)
    {
        $query = "SELECT * 
                  FROM user
                  WHERE id <> ?";

        if($request->get('userName') !== '')
        {
            $user = $request->get('userName');
            $query .= " AND user.login LIKE '%$user%'";
        }

        $query .= " LIMIT ?, 20";

        $results = DB::select($query, [$_SESSION['user']->getId(), ($request->get('page') - 1) * 20]);
        $users = array();

        if(count($results) > 0)
        {
            foreach($results as $result)
            {
                array_push($users, new User($result));
            }
        }

        $query = "SELECT COUNT(*) / 20 AS total_pages 
                  FROM user
                  WHERE id <> ?";

        $results = DB::select($query, [$_SESSION['user']->getId()]);

        $model = new GestionUserViewModel();
        $model->setUsers($users);
        $model->setPage($request->get('page'));

        $total = $results[0]->total_pages;
        $total = (int)$total == (float)$total ? (int)$total : (int)$total + 1;

        $model->setTotal_pages($total);

        return view('partial.gestionUsers', ['model' => $model]);
    }

    public function updateUserRole(Request $request)
    {
        $query = "UPDATE user 
                SET role = ?
                WHERE id = ?";

        DB::update($query, [$request->get('role'), $request->get('userId')]);
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

        $query .= " LIMIT 20";
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
    }

    public function acceptUserCommentaire(Request $request)
    {     
        DB::update("UPDATE commentaire SET valide = 1 WHERE id = ?", [$request->get('commentaireId')]);
    }
}