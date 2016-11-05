<?php

namespace framework\other;

use framework\other\Mcrypt;

class Cookie
{
    /**
     *
     * @var object
     */
    private $mobject;
    
    /**
     * 
     * @param string $name
     * @param mixed $value
     * @param time|string $time
     * @param string $domens
     * @param boolean $httponly
     */
    public function set(string $name, $value, $time = false, $domens = false, $httponly = false)
    {
        $value = $this->mcrypt()->encrypt($value);
        setcookie($name, $value, $time, $domens, $httponly);
    }
    
    /**
     * 
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
    }
    
    /**
     * 
     * @param string $name
     * @return boolean
     */
    public function has($name)
    {
        if ($_COOKIE[$name] !== null) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * 
     * @return object
     */
    private function mcrypt()
    {
        if ($this->mobject == null) {
            $this->mobject = new Mcrypt;
        }
        return $this->mobject;
    }

}