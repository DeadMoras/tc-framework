<?php

namespace Framework\Different;

class Cookie
{
    private static $instance;

    public static function getInstance(): Cookie
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct() {}

    private function __clone() {}
 

    private function __wakeup() {}
    
    /**
     * 
     * @param string $name
     * @param string $value
     * @param boolean $time
     * @param boolean $domens
     * @param boolean $httponly
     */
    public static function set(string $name, string $value, $time = false, $domens = false, $httponly = false)
    {
        setcookie($name, $value, $time, $domens, $httponly);
    }
    
    /**
     * 
     * @param string $name
     * @return string
     */
    public static function get($name)
    {
        return !$_COOKIE[$name] ? 'пусто' : $_COOKIE[$name];
    }
    
    /**
     * 
     * @param string $name
     */
    public static function remove($name)
    {
        setcookie($name, "0", time() - 1, "/");
    }
    
    /**
     * 
     * @param string $name
     * @return boolean
     */
    public static function has($name)
    {
        if ($_COOKIE[$name] !== null) {
            return true;
        } else {
            return false;
        }
    }

}
