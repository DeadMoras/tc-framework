<?php

namespace framework\routes;

use framework\factory\Factory;
use framework\routes\RouterB;

class Router extends Factory
{
    private $object;

    public function __construct()
    {
        $this->object = parent::__construct(new RouterB);
    }

    public function all($pattern, $fn)
    {
        $this->object->match('ALL', $pattern, $fn);
    }

    public function get($pattern, $fn)
    {
        $this->object->match('GET', $pattern, $fn);
    }

    public function post($pattern, $fn)
    {
        $this->object->match('POST', $pattern, $fn);
    }

    public function put($pattern, $fn)
    {
        $this->object->match('PUT', $pattern, $fn);
    }

    public function patch($pattern, $fn)
    {
        $this->object->match('PATCH', $pattern, $fn);
    }

    public function delete($pattern, $fn)
    {
        $this->object->match('DELETE', $pattern, $fn);
    }

    public function options($pattern, $fn)
    {
        $this->object->match('OPTIONS', $pattern, $fn);
    }

    public function run($callbuck = null)
    {
        $this->object->run();
    }
}
