<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT']);

require ROOT . '/framework/app.php';

function csrf_token()
{
	$cookie = new \framework\other\Cookie;
	return $cookie->get('csrf');
}