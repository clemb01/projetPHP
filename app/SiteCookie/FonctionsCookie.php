<?php
 
namespace App\SiteCookie;
 
use ParagonIE\Cookie\Cookie;
use SebastianBergmann\Environment\Console;

trait FonctionsCookie {
    
    public static function setSessionCookie(string $value): Void {
        $cookie = new \ParagonIE\Cookie\Cookie('supersite_session');
        $cookie->setValue(FonctionsCookie::encryptCookieValue($value));
        $cookie->setMaxAge(3600);
        $cookie->setHttpOnly(true);
        $cookie->save();
    }

    public static function getSessionCookieValue(string $cookieValue): String {
        return FonctionsCookie::decryptCookieValue($cookieValue);
    }
 
    public static function unsetSessionCookie(): Void {
        unset($_SESSION['user']);
        $cookie = new \ParagonIE\Cookie\Cookie('supersite_session');
        $cookie->setValue('');
        $cookie->setHttpOnly(true);
        $cookie->save();
        $cookie->delete();
    }
 
    private static function encryptCookieValue(string $value): String {
        return openssl_encrypt($value, 'aes-256-ctr', '2B4D6251655468576D5A7134743777217A25432A462D4A614E635266556A586E', 0, "dOwZC3KXXuUN0Wd\0") . '|' . "dOwZC3KXXuUN0Wd\0";
    }
 
    private static function decryptCookieValue(string $value): String {
        $valueAndIv = explode('|', $value);
        $decryptedValue = '';
 
        try {
            $decryptedValue = openssl_decrypt($valueAndIv[0], 'aes-256-ctr', '2B4D6251655468576D5A7134743777217A25432A462D4A614E635266556A586E', 0, $valueAndIv[1]);
        } catch (\Exception $e) {
            FonctionsCookie::unsetSessionCookie();
        }
        return $decryptedValue;
    }

}