<?php

namespace framework\validate;

use framework\validate\ValidateL;
use framework\validate\ValidateInt;

class ValidateB extends ValidateL implements ValidateInt
{
    /**
     *
     * @var array
     */
    private $data;

    /**
     *
     * @var array
     */
    private $inputs;

    /**
     * Метод для валидации (задания условий и названия полей)
     * $data - все веденные данные
     * @param array $data
     * @param array $params
     */
    public function valid(array $data, array $params)
    {
        if ( is_array($params) ) {
            // Перебираем все заданные параметры вместе с названиями полей
            foreach ( $params as $key => $item ) {
                // Обрезаем по |
                // На выходе каждое условие - новый индекс в массиве
                $methods = explode('|', $item);

                $this->inputs = $key;
                $this->data = $data;

                // Перебираем для min и max
                foreach ( $methods as $method ) {
                    $toCall = explode(':', $method);
                    $this->getValidate($toCall);
                }
            }
        }
    }

    /**
     *
     * @param array $toCall
     */
    public function getValidate($toCall)
    {
        $parent = new parent();

        // Если нету заданных "условий" (разделение : )
        if ( count($toCall) == 1 ) {
            call_user_func([$parent, $toCall[0]], $this->data, $this->inputs);
        } else {
            // Иначе передаем и заданную длинную(для max | min
            call_user_func([$parent, $toCall[0]], $this->data, $this->inputs, $toCall[1]);
        }
    }
}
