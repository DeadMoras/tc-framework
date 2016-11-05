<?php

namespace framework\model;

interface ModelInt
{
    /**
     * 
     * @param string $model
     * @param string $action
     * @param mixed $data
     */
    public function init(string $model, string $action, $data);

    /**
     * 
     * @param array $modelAction
     * @param mixed $data
     */
    public function getArrayInit(array $modelAction, $data);
}
