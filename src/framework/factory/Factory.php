<?php

// Без понятия насколько полезен этот класс, но мне понравилась реализация.
// Вся работа класса заключается в том, что он должен вернуть объект.

namespace framework\factory;

abstract class Factory
{
    /**
     * Factory constructor.
     * @param $object
     */
    protected function __construct($object)
    {
        return $object;
    }
}
