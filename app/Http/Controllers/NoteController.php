<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Note;

class NoteController extends BaseController
{
    public function getMovieRate(Request $request)
    {
        $rate = DB::select("SELECT AVG(note) as moyenne, COUNT(note) as nbvotes FROM note WHERE film_id = ?", [$request->get('movieId')]);

        if(!$rate || $rate[0]->moyenne === NULL)
            return view('partial.movieRate', ['note' => -1]);

        return view('partial.movieRate', ['note' => $rate[0]->moyenne, 'nbvotes' => $rate[0]->nbvotes]);
    }

    public function getUserMovieRate(Request $request)
    {
        if(!empty($_SESSION['user']))
        {
            $result = DB::select("SELECT * FROM note WHERE fk_user_id = ? AND film_id = ? LIMIT 1", [1, $request->get('movieId')]);

            if(count($result) > 0)
                $userRate = new Note($result[0]);
            else
            {
                $userRate = new Note(null);
                $userRate->setFilm_Id($request->get('movieId'));
                $userRate->setNote(-1);
            }

            return view('partial.movieUserRate', ['model' => $userRate]);
        }
        else
        {
            return "Vous devez etre connecté pour noter !";
        }
    }

    // POST
    public function rateMovie(Request $request)
    {
        $userRate = DB::select("SELECT * FROM note WHERE fk_user_id = ? AND film_id = ?", [1, $request->get('movieId')]);

        if($userRate) {
            DB::update("UPDATE note SET note = ? WHERE fk_user_id = ? AND film_id = ?", [$request->get('rating'), 1, $request->get('movieId')]);
        }
        else {
            DB::insert("INSERT INTO note (note, film_id, fk_user_id) values (?, ?, ?)", [$request->get('rating'), $request->get('movieId'), 1]);
        }
    }
}