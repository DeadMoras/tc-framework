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
     * 
     * @param array $data
     * @param array $params
     */
    public function valid(array $data, array $params)
    {
        $parent = new parent();
        if (is_array($params)) {
            foreach ($params as $key => $item) {
                $methods = explode('|', $item);
                $this->inputs = $key;
                $this->data = $data;
                foreach ($methods as $method) {
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
        if (count($toCall) == 1) {
            call_user_func([$parent, $toCall[0]], $this->data, $this->inputs);
        } else {
            call_user_func([$parent, $toCall[0]], $this->data, $this->inputs, $toCall[1]);
        }
    }
}
