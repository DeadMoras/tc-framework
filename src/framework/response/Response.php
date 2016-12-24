<?php

// Класс для обеспечения "интерфейса" между пользователем (имеется виду, - человеком, который будет писать код, используя
// класс Response) и самим классом.
// То есть, это что-то типа посредника, который задает свои правила для вызова , а затем, делегирует вызов методов.
// Этот класс ровным счетом ничего не делает !!!
// Он всего лишь создает объект нужного ему класса (средствами класса Factory и __construct) и производит делегирование методов

namespace framework\response;

use framework\factory\Factory;

class Response extends Factory
{
    /**
     * При каждом $response = new Response() (создание объекта), сюда помещается новый объекта класса ResponseB(ResponseBase)
     * @var object
     */
    private $object;

    public function __construct()
    {
        $this->object = parent::__construct(new ResponseB);
    }

    /**
     *
     * @param bool $code
     * @return mixed
     */
    public function code($code = false)
    {
        return $this->object->status($code);
    }

    /**
     *
     * @param string $key
     * @param string $values
     * @return $this
     * @internal param bool $replace
     */
    public function header(string $key, string $values)
    {
        $this->object->header($key, $values);

        return $this;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->object->setContent($content);

        return $this;
    }

    /**
     * @param string $url
     * @return mixed
     */
    public function redirect(string $url)
    {
        return $this->object->redirect($url);
    }

    /**
     * @param string $json
     * @return mixed
     */
    public function json($json)
    {
        return $this->object->json($json);
    }
}
