<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProfilController extends BaseController
{
    public function getProfil($userName)
    {
        $result = DB::select("SELECT * FROM user WHERE login = ?", [$userName]);

        $user = new User($result[0]);

        return view('profil', ['user' => $user]);
    }

    public function MakeAnonymeUser(Request $request)
    {
        $query = "UPDATE user SET login = 'UtilisateurSupprime " . date("Y-m-d H:i:s") . "', nom = '', prenom = '', dateN = '2000-01-01' WHERE login = ?";

        DB::update($query, [$_SESSION['user']->getLogin()]);

        return redirect('/accueil');
    }
}
