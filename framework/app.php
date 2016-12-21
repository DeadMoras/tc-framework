<?php

session_start();

require 'vendor/autoload.php';
require 'app/route/routes.php';

$config = [
   'driver' => \framework\other\Config::get('db_connect.driver'),
   'host' => \framework\other\Config::get('db_connect.host'),
   'database' => \framework\other\Config::get('db_connect.db'),
   'username' => \framework\other\Config::get('db_connect.user'),
   'password' => \framework\other\Config::get('db_connect.password'),
   'charset' => \framework\other\Config::get('db_connect.charset'),
   'collation' => \framework\other\Config::get('db_connect.collation'),
   'prefix' => \framework\other\Config::get('db_connect.prefix'),
   'options' => [
       \PDO::ATTR_TIMEOUT => 5,
       \PDO::ATTR_EMULATE_PREPARES => false,
   ],
];

new \Pixie\Connection('mysql', $config, 'DB');

$router->run();
