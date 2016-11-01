<?php

namespace Framework\Controllers;

class Validate
{
    /**
     *
     * @var string
     */
    protected static $data;

    /**
     * [$errors all errors]
     * @return array
     */
    public static $errors = [];

    /**
     * 
     * @param array $dataInput
     * @param array $validate
     * @return void or errors
     */
    public function getValidate($dataInput, $validate)
    {
        $self = new self();

        if (is_array($validate)) {
            foreach ($validate as $key => $item) {
                $methods = explode('|', $item);
                foreach ($methods as $method) {
                    $toCall = explode(':', $method);
                    if (count($toCall) == 1) {
                        call_user_func([$self, $toCall[0]], $dataInput, $key);
                    } else {
                        call_user_func([$self, $toCall[0]], $dataInput, $key, explode(',', $toCall[1]));
                    }
                }
            }
        } else {
            $this->errors[] = 'Нечего проверять';
            return false;
        }
    }

    /**
     * 
     * @return string
     */
    public function getErrors()
    {
        if (!empty(self::$errors)) {
            foreach (self::$errors as $key => $value) {
                echo $value;
            }
        }
        return false;
    }

    /**
     * 
     * @param array $data
     * @param string $inputs
     * @return string
     */
    protected static function inputsForeach($data, $inputs)
    {
        foreach ($data as $key => $value) {
            if ($inputs === $key) {
                self::$data = $key;
                return $value;
            }
        }
    }

    /**
     * 
     * @param array $data
     * @param string $inputs
     * @return string
     */
    public static function required($dataInputs, $input)
    {
        $data = self::inputsForeach($dataInputs, $input);
        if (strlen($data) <= 0) {
            self::$errors[] = self::$data.' '.\Framework\Different\Config::getInstace()->get('errors_messages.required').'<br>';
            return false;
        }
    }

    public static function min($dataInputs, $input, $minLength)
    {
        $data = self::inputsForeach($dataInputs, $input);
        if (strlen($data) <= $minLength[0]) {
            self::$errors[] = self::$data.' '.\Framework\Different\Config::getInstace()->get('errors_messages.min').$minLength[0].'<br>';
            return false;
        }
    }

    public static function max($dataInputs, $input, $maxLength)
    {
        $data = self::inputsForeach($dataInputs, $input);
        if (strlen($data) > $maxLength[0]) {
            self::$errors[] = self::$data.' '.\Framework\Different\Config::getInstace()->get('errors_messages.min').$maxLength[0].'<br>';
            return false;
        }
    }

    public function correct()
    {
        if (empty(self::$errors)) {
            return true;
        } else {
            return false;
        }
    }
}
