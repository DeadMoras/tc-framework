<?php

namespace Framework\Models;

class Model implements \Framework\Interfaces\BaseModel
{

    /**
     *
     * @var string
     */
    private static $model;

    /**
     *
     * @var string 
     */
    private static $method;

    /**
     *
     * @var array
     */
    private static $info;

    /**
     * 
     * @param string $model
     * @param string $method
     * @param array $data
     * @return void
     */
    public static function get($model, $method, $data)
    {
        static::$model = \Framework\Different\Config::getInstace()->get('url_models.url').$model;
        static::$method = $method;
        static::$info = $data;
        return static::sendInfo();
    }

    /**
     * 
     * @return mixed
     */
    public static function sendInfo()
    {
        $controller = new static::$model();
        return $controller->{static::$method}(static::$info);
    }

}
