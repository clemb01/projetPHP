<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class NoteController extends BaseController
{
    public function getMovieRate(Request $request)
    {
        return view('partial.movieRate', ['note' => 4]);
    }

    public function getUserMovieRate(Request $request)
    {
        return view('partial.movieUserRate', ['movieId' => $request->get('movieId'), 'note' => 2.5]);
    }

    // POST
    public function rateMovie(Request $request)
    {
        //return redirect('/movie/'.$request->get('movieId'));
        return var_dump($request->get('rating'));
    }
}