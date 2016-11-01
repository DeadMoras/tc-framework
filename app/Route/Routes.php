<?php

use Framework\Controllers\Router;

Router::get('/', '\App\Controllers\MainController@getIndex');
Router::post('/auth', '\App\Controllers\MainController@auth');
