<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\SiteCookie\FonctionsCookie;

class ModifUserController extends BaseController
{
    public function getModif()
    {
        if(empty($_SESSION['user']))
        {
            return redirect('/accueil');
        }
        else
        {
            $result = DB::select("SELECT * FROM user WHERE login = ?",[$_SESSION['user']->getLogin()]);
            $user = new User($result[0]);
            return view('modifUser',['user' => $user]);
        }
    }

    public function updateUser(Request $request)
    {
        if(!empty($_SESSION['user']))
        {

            DB::update("UPDATE user SET nom = ?, prenom = ?, login = ? WHERE id = ?", [$request->get('nom'), $request->get('prenom'),$request->get('pseudo'), $_SESSION['user']->getId()]);
            
            $user = User::getUserByLogin($request->get('pseudo'));
        
            if(!empty($user)){
                
                FonctionsCookie::setSessionCookie($user->getLogin());
            }

            return redirect("/profil");
        }
        else
        {
            return view('modifUser');
        }

    }

    public function checkLoginExist(Request $request)
    {
        $check = '';

        $results = DB::select("SELECT * FROM user WHERE login = ? AND id <> ?",[$request->get('pseudo'),$_SESSION['user']->getId()]);
        
        if(count($results) > 0)
        {
            
            $check = 'true';
        }
        else
        {
            $check = 'false';
        }

        return $check;

    }
}