<?php

namespace Framework\Controllers;

use \Framework\Controllers\RequestBase;

/**
  Main request class for all project
 */
class Request
{
    /**
     * 
     * @param string $container
     * @return array
     * @throws \Exception
     */
    public function get(string $container)
    {
        try {
            if ($_GET[$container]) {
                return RequestBase::get($container);
            } else {
                throw new \Exception("Не корректный метод", 1);
            }
        } catch (Error $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     * @param string $container
     * @return array
     */
    public function input($container)
    {
        return RequestBase::getInputs($container);
    }

    /**
     * 
     * @return array
     */
    public function getAll()
    {
        return RequestBase::getParse();
    }

    /**
     * 
     * @param type $object
     * @return json
     */
    public function json(...$object)
    {
        return json_encode($object);
    }

    /**
     * 
     * @param string $string
     * @param boolean $type
     * @return string
     */
    public function bcrypt(string, $string, $type = false)
    {
        return $type == false ? password_hash($string, PASSWORD_DEFAULT) : password_hash($string, $type);
    }
}
