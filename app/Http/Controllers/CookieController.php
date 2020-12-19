<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\SiteCookie\FonctionsCookie;
use ParagonIE\Cookie\Cookie;

class CookieController extends BaseController
{
    public function loginAction(Request $request){
        
        $password = $request->get('mdp_user');

        $user = User::getUserByLogin($request->get('login_user'));
        
        if(!empty($user) && $user->getPassword() === $password){
            
            FonctionsCookie::setSessionCookie($user->getLogin());
            return redirect("/");
        }
        else
        {
            return redirect("/");
        }
    }

    public function logoutAction(Request $request){
        FonctionsCookie::unsetSessionCookie();

        if(!empty($request->get('returnUrl')))
            return Redirect($request->get('returnUrl'));
        else
            return Redirect('/accueil');
    }
}