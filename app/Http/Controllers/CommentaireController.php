<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\CommentaireViewModel;
use App\Models\Commentaire;

class CommentaireController extends BaseController
{
    public function getUserMovieComms(Request $request)
    {
        $userComms = DB::select("SELECT commentaire.*, user.login 
                                    FROM commentaire 
                                    LEFT OUTER JOIN user 
                                    ON commentaire.fk_user_id = user.id 
                                    WHERE valide = 1 AND film_id = ?", [$request->get('movieId')]);
        $commentaires = array();
        foreach ($userComms as $comm) {
            array_push($commentaires, new CommentaireViewModel($comm));
        }
        return view('partial.Comms', ['commentaires' => $commentaires, 'isMoviepage' => true]);
    }

    public function saveComms(Request $request)
    {
        if (!empty($_SESSION['user']) && ($_SESSION['user']->getRole() == "admin" || $_SESSION['user']->getRole() == "modo")) {
            DB::insert("INSERT INTO commentaire (contenu, date, valide, valideModif, film_id, fk_user_id, Film_titre ,Film_logo) values (?, ?, ?, ?, ?, ?, ?, ?)", [$request->get('Message'), date("Y-m-d H:i:s"), 1, 0, $request->get('MovieId'), $_SESSION['user']->getId(), $request->get('MovieName'), $request->get('MovieLogo')]);
        } else {
            DB::insert("INSERT INTO commentaire (contenu, date, valide, valideModif, film_id, fk_user_id, Film_titre ,Film_logo) values (?, ?, ?, ?, ?, ?, ?, ?)", [$request->get('Message'), date("Y-m-d H:i:s"), 0, 0, $request->get('MovieId'), $_SESSION['user']->getId(), $request->get('MovieName'), $request->get('MovieLogo')]);
        }

        $id = $request->get('MovieId');

        return redirect("/movie/$id");
    }

    public function getAllUserComms(Request $request)
    {
        $userComms = DB::select("SELECT commentaire.*, user.login 
                                 FROM commentaire 
                                 LEFT OUTER JOIN user 
                                 ON commentaire.fk_user_id = user.id 
                                 WHERE fk_user_id = ?", [$request->get('userId')]);

        $commentaires = array();
        foreach ($userComms as $comm) {
            array_push($commentaires, new CommentaireViewModel($comm));
        }

        return view('partial.Comms', ['commentaires' => $commentaires, 'isMoviepage' => false]);
    }

    public function getUserMovieComm(Request $request)
    {
        $userComms = DB::select("SELECT * 
                                    FROM commentaire 
                                    WHERE id = ?", [$request->get('comm_id')]);

        $commentaire = new Commentaire($userComms[0]);

        return view('partial.ModalComm', ['commentaire' => $commentaire]);
    }

    public function ModifComms(Request $request)
    {
        if (!empty($_SESSION['user']) && ($_SESSION['user']->getRole() == "admin" || $_SESSION['user']->getRole() == "modo")) {
            DB::update("UPDATE commentaire SET contenu = ? WHERE id = ?", [$request->get("Message"), $request->get("comm_id")]);
        } else {
            DB::update("UPDATE commentaire SET nouveauContenu = ?, valideModif = 1 WHERE id = ?", [$request->get("Message"), $request->get("comm_id")]);
        }

        $id = $request->get('MovieId');

        return redirect("/movie/$id");
    }

    public function suppComms(request $request)
    {
        DB::delete("DELETE FROM commentaire WHERE id = ?", [$request->get("comm_id")]);

        $id = $request->get('MovieId');

        return redirect("/movie/$id");
    }
}
