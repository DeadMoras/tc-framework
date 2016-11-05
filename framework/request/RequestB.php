<?php

namespace framework\request;

use framework\request\RequestL;

class RequestB extends RequestL
{
    /**
     *
     * @var array
     */
    protected $data;

    /**
     * 
     * @param array $name
     * @return string
     */
    public function input($name)
    {
        if (is_array($name)) {
            $this->array_input($name);
            return $this->foreachData();
        } else {
            return parent::postInput($name);
        }
    }

    /**
     * 
     * @param array $object
     */
    public function array_input(array $object)
    {
        foreach ($object as $v) {
            $result = parent::postInput($v);
            $this->data[] = $result;
        }
    }

    /**
     * 
     * @param json $object
     * @return mixed
     */
    public function json($object)
    {
        return json_encode($object);
    }

    /**
     * 
     * @return array
     */
    public function all()
    {
        return parent::getAll();
    }

    /**
     * 
     */
    public function foreachData()
    {
        foreach ($this->data as $k) {
            echo $k;
        }
    }
}
