<?php

namespace framework\request;

use framework\request\RequestB;
use framework\facade\Facade;

class Request extends Facade
{
    /**
     *
     * @var object
     */
    private $object;

    /**
     * [__construct description]
     */
    public function __construct()
    {
        $this->object = parent::__construct(new RequestB);
    }

    /**
     * 
     * @param array $name
     * @return string
     */
    public function input($name)
    {
        return $this->object->input($name);
    }

    /**
     * 
     * @param array $object
     * @return void
     */
    public function array_input(array $object)
    {
        return $this->object->array_input($object);
    }

    /**
     * 
     * @param mixed $object
     * @return json
     */
    public function json($object)
    {
        return $this->object->json($object);
    }

    /**
     * 
     * @return array
     */
    public function all()
    {
        return $this->object->all();
    }

    /**
     * 
     * @return string
     */
    public function foreachData()
    {
        return $this->object->foreachData();
    }
}
