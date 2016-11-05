<?php

namespace framework\validate;

use framework\facade\Facade;

class Validate extends Facade
{
    /**
     *
     * @var object
     */
    private $object;
    
    /**
     * __construct
     */
    public function __construct()
    {
        $this->object = parent::__construct(new ValidateB);
    }
    
    /**
     * 
     * @param array $data
     * @param array $params
     * @return void
     */
    public function valid(array $data, array $params)
    {
        return $this->object->valid($data, $params);
    }

    /**
     * 
     * @return boolean
     */
    public function correct()
    {
        return $this->object->correct();
    }

    /**
     * 
     * @return string
     */
    public function getErrors()
    {
        return $this->object->getErrors();
    }

}
