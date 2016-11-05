<?php

namespace framework\request;

class RequestL
{
    /**
     * 
     * @param string $input
     * @return string
     */
    public static function postInput($input)
    {
        $text = self::getPost($input);
        return self::patternText($text);
    }

    /**
     * 
     * @param string $input
     * @return string
     */
    public static function getPost($input)
    {
        return $_POST[$input];
    }

    /**
     * 
     * @return array
     */
    public static function getAll()
    {
        $input = file_get_contents('php://input');
        parse_str($input, $data);
        return $data;
    }

    /**
     * 
     * @param string $text
     * @return string
     */
    public static function patternText($text)
    {
        return trim(strip_tags(htmlspecialchars($text)));
    }
}
