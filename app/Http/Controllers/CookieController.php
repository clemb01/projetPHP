<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\SiteCookie\FonctionsCookie;

class CookieController extends BaseController
{
    public function loginAction(Request $request){
        
        //$password = hash('sha256',$request->get('mdp_user'));
        $password = $request->get('mdp_user');

        $user = User::getUserByLogin($request->get('login_user'));
        //$user = DB::select("SELECT * FROM user WHERE login = ? LIMIT 1", [$request->get('login_user')]);
        
        //return var_dump($user);
        
        if(!empty($user) && $user->getPassword() === $password){

            //FonctionsCookie::setSessionCookie($user->getAttributeValue($user->getLogin()));
            FonctionsCookie::setSessionCookie($user->getLogin());
            return redirect("/");
        }
        else
        {
            return redirect("/");
        }
    }
}