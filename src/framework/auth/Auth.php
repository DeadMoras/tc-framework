<?php

// Класс для обеспечения "интерфейса" между пользователем (имеется виду, - человеком, который будет писать код, используя
// класс Auth) и самим классом.
// То есть, это что-то типа посредника, который задает свои правила для вызова , а затем, делегирует вызов методов.
// Этот класс ровным счетом ничего не делает !!!
// Он всего лишь создает объект нужного ему класса (средствами класса Factory и __construct) и производит делегирование методов

namespace framework\auth;

use \framework\auth\AuthB;
use \framework\factory\Factory;

class Auth extends Factory
{
    /**
     * При каждом $auth = new Auth() (создание объекта), сюда помещается новый объекта класса AuthB(AuthBase)
     * @var object
     */
    private $object;

    /**
     * Используется во всех классах для дальнейшего делегирования вызовов метода
     * Auth constructor.
     */
    public function __construct()
    {
        $this->object = parent::__construct(new AuthB);
    }

    /**
     *
     * @param array $data
     * @return boolean
     */
    public function attempt(array $data)
    {
        return $this->object->attempt($data);
    }

    /**
     *
     * @return boolean
     */
    public function check()
    {
        return $this->object->check();
    }

    /**
     *
     * @return mixed
     */
    public function user()
    {
        return $this->object->user();
    }
}
