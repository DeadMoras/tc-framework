<?php

namespace Framework\Controllers;

class Response
{
    /**
     * 
     * @param string $url
     */
    public static function responseUrl($url)
    {
        header("Location: $url");
    }
    
    /**
     * 
     * @param string $name
     */
    public static function headerContent($name)
    {
        header("Content-type: $name");
    }
}
