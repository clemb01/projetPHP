<?php

namespace App\Http\Middleware;

use Closure;
use App\SiteCookie\FonctionsCookie;
use App\Models\User;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $encryptedLogin = $request->cookie('supersite_session');
        //return var_dump($encryptedLogin);

        if (empty($encryptedLogin))
            return $next($request);
 
        $login = FonctionsCookie::getSessionCookieValue($encryptedLogin);
    
        if (!empty($login)) {
            $user = User::getUserByLogin($login);
            if (!empty($user)) {
                unset($user['stringPassword']);
                $_SESSION['user'] = $user;
                FonctionsCookie::setSessionCookie($login);
            }
            else {
                FonctionsCookie::unsetSessionCookie();
            }
        }
 
        return $next($request);
    }
}
