<?php

namespace framework\other;

use \framework\other\Cookie;

class Csrf
{
    /**
     *
     * @var object
     */
    private $cookie;
    
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
        $newToken = $token . ':' . md5($token . ':' . 'lw/e1203q.weks');
        return $newToken;
    }
    
    /**
     * 
     * @param string $token
     * @return boolean
     */
    private function checkTokenPrivate(string $token)
    {
        if ($this->cookie()->has('csrf') && $this->cookie()->has('token')) {
            $tokenCookie = $this->cookie()->get('csrf') . ':' . md5($this->cookie()->get('csrf') . ':' . 'lw/e1203q.weks');
            $tokenCheck = $token . ':' . md5($token . ':' . 'lw/e1203q.weks');
            if ($tokenCheck === $tokenCookie) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function cookie()
    {
        if ($this->cookie == null) {
            $this->cookie = new Cookie;
        }
        return $this->cookie;
    }
}
