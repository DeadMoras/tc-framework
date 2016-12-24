<?php

namespace framework\validate;

use framework\request\Request;

class ValidateL
{
    /**
     *
     * @var array
     */
    public static $errors;

    /**
     * Название инпута
     * @var string
     */
    private static $key;

    /**
     *
     * @param array $inputs
     * @param array $data
     * @return boolean
     */
    public static function required($data, $inputs)
    {
        $data = self::inputsForeach($data, $inputs);
        if ( strlen($data) <= 0 ) {
            self::$errors[] = self::$key . ' поле не может быть пустым';

            return false;
        }
    }

    /**
     *
     * @param array $data
     * @param array $inputs
     * @param string $minLength
     * @return boolean
     */
    public static function min($data, $inputs, $minLength)
    {
        $data = self::inputsForeach($data, $inputs);
        if ( strlen($data) <= $minLength ) {
            self::$errors[] = self::$key . ' поле не может быть меньше, чем ' . $minLength;

            return false;
        }
    }

    /**
     *
     * @param array $data
     * @param array $inputs
     * @param string $maxLength
     * @return boolean
     */
    public static function max($data, $inputs, $maxLength)
    {
        $data = self::inputsForeach($data, $inputs);
        if ( strlen($data) >= $maxLength ) {
            self::$errors[] = self::$key . ' поле не может быть больше, чем ' . $maxLength;

            return false;
        }
    }

    /**
     * Используется каждым методом который принимает участие в валидации.
     * Т.е, required, min, max вызывают его.
     * Делает проверку на соответствие заданного инпута со всеми переданными(веденные)
     * данные с формы, и возвращает название инпута и его значение
     * @param array $data
     * @param string $inputs
     * @return string
     */
    private static function inputsForeach($data, $inputs)
    {
        foreach ( $data as $key => $value ) {
            if ( $inputs == $key ) {
                self::$key = $key;

                return $value;
            }
        }
    }

    /**
     *
     * @return boolean
     */
    public function getErrors()
    {
        if ( !empty(self::$errors) ) {
            foreach ( self::$errors as $key => $value ) {
                echo $value . '<br>';
            }
        }

        return false;
    }

    /**
     *
     * @return boolean
     */
    public function correct()
    {
        if ( empty(self::$errors) ) {
            return true;
        } else {
            return false;
        }
    }

}
