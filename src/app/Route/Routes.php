<?php

$router = new \framework\routes\Router;

$router->get('/', '\app\controller\Test@get');
