<?php

namespace Framework\Controllers;

class Response
{
    public static function responseUrl($url)
    {
        header("Location: $url");
    }
}
