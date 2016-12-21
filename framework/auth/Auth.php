<?php

namespace framework\auth;

use \framework\auth\AuthB;
use \framework\factory\Factory;

class Auth extends Factory
{
    /**
     *
     * @var object
     */
    private $object;

    public function __construct()
    {
        $this->object = parent::__construct(new AuthB);
    }
    
    /**
     * 
     * @param array $data
     * @return boolean
     */
    public function attempt(array $data)
    {
        return $this->object->attempt($data);
    }
    
    /**
     * 
     * @return boolean
     */
    public function check()
    {
        return $this->object->check();
    }
    
    /**
     * 
     * @return mixed
     */
    public function user()
    {
        return $this->object->user();
    }
}
