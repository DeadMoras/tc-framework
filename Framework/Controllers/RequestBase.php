<?php

namespace Framework\Controllers;

/**
  helper for Request
 */
abstract class RequestBase
{
    public static function getParse()
    {
        $input = file_get_contents('php://input');
        parse_str($input, $data);
        return $data;
    }

    /**
     * 
     * @param string $input
     * @return array
     */
    public static function get(string $input)
    {
        return trim(htmlspecialchars($_GET['input']));
    }

    /**
     * 
     * @param string $inputs
     * @return array
     */
    public static function getInputs(string $inputs)
    {
        return trim(htmlspecialchars($_POST[$inputs]));
    }
}
