<?php

session_start();

require 'vendor/autoload.php';
require 'app/route/routes.php';
require 'app/config/template.php';

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

function assets($name)
{
    return '/app/public/'.$name;
}

function loadJs()
{
    foreach ( \app\config\template::getJs() as $key ) {
        echo '<script src="'.assets('js/'.$key).'"></script>';
    }
}

function loadCss()
{
    foreach ( \app\config\template::getCss() as $key ) {
        echo '<link rel="stylesheet" href="'.assets('css/'.$key).'">';
    }
}

$router->run();