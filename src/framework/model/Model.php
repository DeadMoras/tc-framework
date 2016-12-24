<?php

// Класс для обеспечения "интерфейса" между пользователем (имеется виду, - человеком, который будет писать код, используя
// класс Model) и самим классом.
// То есть, это что-то типа посредника, который задает свои правила для вызова , а затем, делегирует вызов методов.
// Этот класс ровным счетом ничего не делает !!!
// Он всего лишь создает объект нужного ему класса (средствами класса Factory и __construct) и производит делегирование методов


// Класс от себя(но он не совсем полезен).
// Его реализация схожа с новой возможностью в php
// (new User)->getInfo();

namespace framework\model;

use framework\factory\Factory;

class Model extends Factory
{
    /**
     * При каждом $model = new Model() (создание объекта), сюда помещается новый объекта класса ModelB(ModelBase)
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
     * Метод для вызова метода в модели.
     * Он отличается от метода 'ainit' только тем, что принимает не массив, а строки.(Название класс, метода)
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
     * Метод для вызова метода в модели.
     * Он отличается от метода 'init' только тем, что принимает не строки, а массив.([Название класс, метода])
     * @param array $modelAction
     * @param mixed $data
     * @return mixed
     */
    public function ainit(array $modelAction, $data)
    {
        return $this->object->ainit($modelAction, $data);
    }
}
