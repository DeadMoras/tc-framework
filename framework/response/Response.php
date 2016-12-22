<?php

namespace framework\response;

use framework\factory\Factory;

class Response extends Factory
{
    /**
     *
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
    public function header($key, $values)
    {
        $this->object->header($key, $values);

        return $this;
    }

    /**
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->object->setContent($content);

        return $this;
    }

    /**
     * @param string $url
     * @return mixed
     */
    public function redirect($url)
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
