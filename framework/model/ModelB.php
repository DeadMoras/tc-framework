<?php

namespace framework\model;

use framework\model\ModelL;
use framework\model\ModelInt;

class ModelB extends ModelL implements ModelInt
{
    /**
     * 
     * @param string $model
     * @param string $action
     * @param mixed $data
     * @return mixed
     * @throws \Exception
     */
    public function init(string $model, string $action, $data)
    {
        if (is_string($model) && is_string($action)) {
            return $this->getInit($model, $action, $data);
        } else {
            throw new \Exception("Некорретные типы, модель и метод должны быть строкой", 1);
        }
    }

    /**
     * 
     * @param array $modelAction
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function ainit($modelAction, $data)
    {
        if (is_array($modelAction)) {
            return $this->getArrayInit($modelAction, $data);
        } else {
            throw new \Exception("Некорретные типы", 1);
        }
    }

}
