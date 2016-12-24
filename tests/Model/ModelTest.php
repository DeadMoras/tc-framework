<?php

use framework\model\Model;

class ModelTest extends PhpUnit_Framework_TestCase
{
    protected $model;

    protected function setUp()
    {
        $this->model = new Model;
    }

    public function testCallAnyMethodModelWithInit()
    {
        $this->model->init('User', 'method', 'data');
    }

    public function testCallAnyMethodModelWithAinit()
    {
        $this->model->ainit(['User', 'method'], 'data');
    }
}