<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProfilController extends BaseController
{ 
    public function getProfil()
    {
        if(empty($_SESSION['user']))
        {
            return redirect('/accueil');
        }
        else
        {
            $result = DB::select("SELECT * FROM user WHERE login = ?",[$_SESSION['user']->getLogin()]);
            //return var_dump($result);
            $user = new User($result[0]);
            return view('profil',['user' => $user]);
        }
        
    }
}