<?php

session_start();

require 'vendor/autoload.php';
require 'app/route/routes.php';

$config = [
    'driver' => \Framework\Different\Config::get('db_connect.driver'),
    'host' => \Framework\Different\Config::get('db_connect.host'),
    'database' => \Framework\Different\Config::get('db_connect.db'),
    'username' => \Framework\Different\Config::get('db_connect.user'),
    'password' => \Framework\Different\Config::get('db_connect.password'),
    'charset' => \Framework\Different\Config::get('db_connect.charset'),
    'collation' => \Framework\Different\Config::get('db_connect.collation'),
    'prefix' => \Framework\Different\Config::get('db_connect.prefix'),
    'options' => [
        \PDO::ATTR_TIMEOUT => 5,
        \PDO::ATTR_EMULATE_PREPARES => false,
    ],
];

new \Pixie\Connection('mysql', $config, 'DB');

\Framework\Controllers\Router::start();
