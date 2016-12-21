<?php

namespace framework\factory;

abstract class Factory
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
