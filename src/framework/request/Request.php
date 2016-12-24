<?php

// Класс для обеспечения "интерфейса" между пользователем (имеется виду, - человеком, который будет писать код, используя
// класс Request) и самим классом.
// То есть, это что-то типа посредника, который задает свои правила для вызова , а затем, делегирует вызов методов.
// Этот класс ровным счетом ничего не делает !!!
// Он всего лишь создает объект нужного ему класса (средствами класса Factory и __construct) и производит делегирование методов

namespace framework\request;

use framework\request\RequestB;
use framework\factory\Factory;

class Request extends Factory
{
    /**
     * При каждом $request = new Request() (создание объекта), сюда помещается новый объекта класса RequestB(RequestBase)
     *
     * @var Factory
     */
    private $object;

    /**
     * Используется во всех классах для дальнейшего делегирования вызовов метода
     *
     * [__construct description]
     */
    public function __construct()
    {
        $this->object = parent::__construct(new RequestB);
    }

    /**
     *
     * @param mixed $name
     * @return string
     */
    public function input($name)
    {
        return $this->object->input($name);
    }

    /**
     *
     * @param array $object
     * @return void
     */
    public function array_input(array $object)
    {
        return $this->object->array_input($object);
    }

    /**
     *
     * @param mixed $object
     * @return json
     */
    public function json($object)
    {
        return $this->object->json($object);
    }

    /**
     *
     * @return array
     */
    public function all()
    {
        return $this->object->all();
    }

    /**
     *
     * @return string
     */
    public function foreachData()
    {
        return $this->object->foreachData();
    }

    /**
     * @param string $name
     * @return string
     */
    public function get(string $name): string
    {
        return $this->object->get($name);
    }
}
