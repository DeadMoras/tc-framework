<?php

namespace framework\other;

use framework\other\Mcrypt;

class Cookie
{
    /**
     * Mcrypt объект
     * @var object
     */
    private $mobject;

    // Куки объект (Объект данного класса)
    private static $cookie_object;

    private function __construct()
    {
    }

    /**
     * @return Cookie
     */
    public static function instance()
    {
        if ( self::$cookie_object == null && self::$cookie_object == false ) {
            self::$cookie_object = new Cookie;
        }

        return self::$cookie_object;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @param bool $time
     * @param bool $domens
     * @param bool $httponly
     */
    public function set($name, $value, $time = false, $domens = false, $httponly = false): void
    {
        $value = $this->mcrypt()->encrypt($value);
        setcookie($name, $value, $time, $domens, $httponly);

        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        $value = empty($_COOKIE[$name]) ? 'Пусто' : $this->mcrypt()->decrypt($_COOKIE[$name]);

        return $value;
    }

    /**
     *
     * @param string $name
     */
    public function remove($name)
    {
        $this->set($name, "0", time() - 1, "/");

        return $this;
    }

    /**
     *
     * @param string $name
     * @return boolean
     */
    public function has($name): boolean
    {
        return $_COOKIE[$name] !== null ? true : false;
    }

    /**
     *
     * @return object
     */
    private function mcrypt()
    {
        if ( $this->mobject == null ) {
            $this->mobject = new Mcrypt;
        }

        return $this->mobject;
    }

}
