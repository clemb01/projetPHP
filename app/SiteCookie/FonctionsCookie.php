<?php
 
namespace App\SiteCookie;
 
use ParagonIE\Cookie\Cookie;

// define('COOKIE_CYPHER','aes-256-ctr');
// define('COOKIE_SESSION_KEY','supersite_session');
// define('COOKIE_CODE','zaeiyguyYYUEFyeuflkvlmbbpzfUIUGgE478554f774ff8fiezougy5454fgd5f7g8t7r544fsesd7fe867r4fse54r8esr74zda64qz');

trait FonctionsCookie {

    public static function setSessionCookie(string $value): Void {
        Cookie::setcookie('supersite_session', FonctionsCookie::encryptCookieValue($value));
    }

    public static function getSessionCookieValue(string $cookieValue): String {
        return FonctionsCookie::decryptCookieValue($cookieValue);
    }
 
    public static function unsetSessionCookie(): Void {
        unset($_SESSION['user']);
        Cookie::setcookie('supersite_session', '', time() - 3600);
    }
 
    private static function encryptCookieValue(string $value): String {
        $iv_size = openssl_cipher_iv_length('aes-256-ctr');
        try {
            $iv = random_bytes($iv_size);
        } catch (\Exception $e) {
            die();
        }
        return openssl_encrypt($value, 'aes-256-ctr', 'zaeiyguyYYUEFyeuflkvlmbbpzfUIUGgE478554f774ff8fiezougy5454fgd5f7g8t7r544fsesd7fe867r4fse54r8esr74zda64qz', 0, $iv) . '|' . $iv;
    }
 
    private static function decryptCookieValue(string $value): String {
        $valueAndIv = explode('|', $value);
        $decryptedValue = '';
 
        try {
            $decryptedValue = openssl_decrypt($valueAndIv[0], 'aes-256-ctr', 'zaeiyguyYYUEFyeuflkvlmbbpzfUIUGgE478554f774ff8fiezougy5454fgd5f7g8t7r544fsesd7fe867r4fse54r8esr74zda64qz', 0, $valueAndIv[1]);
        } catch (\Exception $e) {
            FonctionsCookie::unsetSessionCookie();
        }
        return $decryptedValue;
    }
}