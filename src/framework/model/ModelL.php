<?php

namespace framework\model;

class ModelL
{
    /**
     * Название класса модели
     * @var string
     */
    private $model;

    /**
     * Название метода модели
     * @var string
     */
    private $action;

    /**
     * @param string $model
     * @param string $action
     * @param $data
     * @return mixed
     */
    public function getInit(string $model, string $action, $data)
    {
        // Записываем в свойство название + папку
        $this->model = '\app\model\\' . $model;

        $this->action = $action;

        return $this->initialization($data);
    }

    /**
     * @param array $modelAction
     * @param $data
     * @return mixed
     */
    public function getArrayInit(array $modelAction, $data)
    {
        // Записываем в свойство название + папку
        $this->model = '\app\model\\' . $modelAction[0];
        $this->action = $modelAction[1];

        return $this->initialization($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function initialization($data)
    {
        return (new $this->model)->{$this->action}($data);
    }
}
