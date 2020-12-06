<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class CommentaireController extends BaseController
{
    
    public function getUserMovieRate(Request $request)
    {
    $userRate = DB::select("SELECT contenu FROM commentaire WHERE film_id = ?", [$request->get('movieId')]);

    if(!$userRate)
        return view('partial.movieUserRate', ['movieId' => $request->get('movieId'), 'commentaire' => -1]);

    return view('partial.movieUserRate', ['movieId' => $request->get('movieId'), 'commentaire' => $userRate[0]->note]);
    }

    public function saveComms(Request $request)
    {
        DB::insert("INSERT INTO commentaire (contenu, date, valide, film_id, fk_user_id) values (?, ?, ?, ?, ?)", [$request->get('Message'), "2020-12-08", 0, $request->get('MovieId'), 1]);
    
        $id = $request->get('MovieId');

        return redirect("/movie/$id");
    }
}
