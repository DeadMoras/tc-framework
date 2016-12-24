<?php

// Класс для обеспечения "интерфейса" между пользователем (имеется виду, - человеком, который будет писать код, используя
// класс Validate) и самим классом.
// То есть, это что-то типа посредника, который задает свои правила для вызова , а затем, делегирует вызов методов.
// Этот класс ровным счетом ничего не делает !!!
// Он всего лишь создает объект нужного ему класса (средствами класса Factory и __construct) и производит делегирование методов


namespace framework\validate;

use framework\factory\Factory;

class Validate extends Factory
{
    /**
     * При каждом $validate = new Validate() (создание объекта), сюда помещается новый объекта класса ValidateB(ValidateBase)
     * @var object
     */
    private $object;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->object = parent::__construct(new ValidateB);
    }

    /**
     *
     * @param array $data
     * @param array $params
     * @return void
     */
    public function valid(array $data, array $params)
    {
        return $this->object->valid($data, $params);
    }

    /**
     *
     * @return boolean
     */
    public function correct()
    {
        return $this->object->correct();
    }

    /**
     *
     * @return string
     */
    public function getErrors()
    {
        return $this->object->getErrors();
    }

}
