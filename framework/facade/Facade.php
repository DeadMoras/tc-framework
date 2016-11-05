<?php

namespace framework\facade;

abstract class Facade
{
    /**
     * 
     * @param object $object
     * @return object
     */
    protected function __construct($object)
    {
        return $object;
    }
}
