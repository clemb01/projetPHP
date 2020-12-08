<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Commentaire;

class CommentaireController extends BaseController
{
    
    public function getUserMovieComms(Request $request)
    {
    $userComms = DB::select("SELECT * FROM commentaire WHERE film_id = ?", [$request->get('movieId')]);
    $commentaires = array();
    foreach($userComms as $comm)
    {
        array_push($commentaires, new Commentaire($comm));
    }
    
    return view('partial.Comms', ['commentaires' => $commentaires]);
    }

    public function saveComms(Request $request)
    {
        DB::insert("INSERT INTO commentaire (contenu, date, valide, film_id, fk_user_id) values (?, ?, ?, ?, ?)", [$request->get('Message'), date("Y-m-d H:i:s"), 0, $request->get('MovieId'), 1]);
    
        $id = $request->get('MovieId');

        return redirect("/movie/$id");
    }

}
