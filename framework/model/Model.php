<?php

namespace framework\model;

use framework\facade\Facade;

class Model extends Facade
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
        $this->object = parent::__construct(new ModelB);
    }

   /**
    * 
    * @param string $model
    * @param string $action
    * @param array $data
    * @return mixed
    */
    public function init(string $model, string $action, $data)
    {
        return $this->object->init($model, $action, $data);
    }

    /**
     * 
     * @param array $modelAction
     * @param mixed $data
     * @return mixed
     */
    public function ainit($modelAction, $data)
    {
        return $this->object->ainit($modelAction, $data);
    }
}
