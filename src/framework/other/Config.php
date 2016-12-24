<?php

namespace framework\other;

class Config
{
    /**
     *
     * @var array
     */
    public static $items = [];

    /**
     *
     * @param type $filepath
     * @return void
     */
    public static function load($filepath)
    {
        if ( file_exists('App/Config/' . $filepath . '.php') ) {
            static::$items = include('App/Config/' . $filepath . '.php');
        } else {
            echo $filepath . ' Не найден ';

            return false;
        }
    }

    /**
     *
     * @param null $key
     * @return string
     */
    public static function get($key = null)
    {
        $input = explode('.', $key);
        $filepath = $input[0];
        unset($input[0]);
        $key = implode('.', $input);
        static::load($filepath);

        return empty($key) ? '' : static::$items[$key];

        return static::$items;
    }
}
