<?php

namespace framework\model;

class ModelL
{
    /**
     *
     * @var string
     */
    private $model;

    /**
     *
     * @var string
     */
    private $action;

    /**
     *
     * @param string $model
     * @param string $action
     * @param mixed $data
     * @return void
     */
    public function getInit($model, $action, $data)
    {
        $this->model = '\app\model\\' . $model;
        $this->action = $action;

        return $this->initialization($data);
    }

    /**
     *
     * @param array $modelAction
     * @param mixed $data
     * @return void
     */
    public function getArrayInit(array $modelAction, $data)
    {
        foreach ( $modelAction as $key => $value ) {
            $this->model = '\app\model\\' . $key;
            $this->action = $value;
        }

        return $this->initialization($data);
    }

    /**
     *
     * @param mixed $data
     * @return void
     */
    public function initialization($data)
    {
        return (new $this->model)->{$this->action}($data);
    }

}
