<?php

namespace framework\other;

use \framework\other\Cookie;

class Csrf
{
    /**
     *
     * @var object
     */
    private static $csrf_object;

    private $csrfKey = 'lw/e1203q.weks';

    private function __construct() {}

    public static function instance()
    {
        if ( self::$csrf_object == null && self::$csrf_object == false ) {
            self::$csrf_object = new Csrf;
        }
        return self::$csrf_object;
    }

    /**
     * 
     * @param string $token
     * @return boolean
     */
    public function check(string $token)
    {
        return $this->checkTokenPrivate($token);
    }
    
    /**
     * 
     * @param string $token
     * @return string
     * @throws \Exception
     */
    public function generate(string $token)
    {
        if (is_string($token)) {
            return $this->generatePrivate($token);
        } else {
            throw new \Exception("Not string", 1);
        }
    }
    
    /**
     * 
     * @param string $token
     * @return string
     */
    private function generatePrivate(string $token)
    {
        $newToken = $token . ':' . md5($token . ':' . $this->csrfKey);
        return $newToken;
    }
    
    /**
     * 
     * @param string $token
     * @return boolean
     */
    private function checkTokenPrivate(string $token)
    {
        $cookie = \framework\other\Cookie::instance();
        if ($cookie->has('csrf') && $cookie->has('token')) {
            $tokenCookie = $cookie->get('csrf') . ':' . md5($cookie->get('csrf') . ':' . $this->csrfKey);
            $tokenCheck = $token . ':' . md5($token . ':' . $this->csrfKey);
            if ($tokenCheck === $tokenCookie) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
