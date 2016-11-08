<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT']);

require ROOT . '/framework/app.php';

function csrf_token()
{
	$cookie = \framework\other\Cookie::instance();
	return $cookie->get('csrf');
}