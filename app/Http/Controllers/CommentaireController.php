<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class CommentaireController extends BaseController
{
    
    public function getUserMovieComms(Request $request)
    {
    $userRate = DB::select("SELECT contenu FROM commentaire WHERE film_id = ?", [$request->get('movieId')]);

    return view('partial.Comms', ['commentaire' => $userRate[0]->critique]);
    }

    public function saveComms(Request $request)
    {
        DB::insert("INSERT INTO commentaire (contenu, date, valide, film_id, fk_user_id) values (?, ?, ?, ?, ?)", [$request->get('Message'), date("Y-m-d H:i"), 0, $request->get('MovieId'), 1]);
    
        $id = $request->get('MovieId');

        return redirect("/movie/$id");
    }

}
