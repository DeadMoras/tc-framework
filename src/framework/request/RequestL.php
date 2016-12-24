<?php

namespace framework\request;

class RequestL
{
    /**
     *
     * @param string $input
     * @return string
     */
    public static function postInput(string $input): string
    {
        // возвращает отфильтрованные данные
        return self::getPost($input);
    }

    /**
     *
     * @param string $input
     * @return string
     */
    public static function getPost(string $input): string
    {
        // вызывает метод, который фильтрует данные, при этом, передает ему уже веденные значения ($_POST)
        return self::patternText($_POST[$input]);
    }

    /**
     *
     * @return array
     */
    public static function getAll(): array
    {
        // используется для $request->all();
        // возвращает все веденные данные
        $input = file_get_contents('php://input');
        parse_str($input, $data);

        return $data;
    }

    /**
     * @param string $name
     * @return string
     */
    public static function getInput(string $name): string
    {
        return self::patternText($_GET[$name]);
    }

    /**
     *
     * @param string $text
     * @return string
     */
    public static function patternText(string $text): string
    {
        // маленькая "защита"
        return trim(strip_tags(htmlspecialchars($text)));
    }
}
