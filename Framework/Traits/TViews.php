<?php

namespace Framework\Traits;

/**
  trait for render view
 */
trait TViews
{

    /**
     * 
     * @param string $template
     * @param boolen $object
     * @return boolean
     */
    public static function view($template, $object = false)
    {
        if ($object != false) {
            extract($object);
        }
        if (stristr($template, '.') === FALSE) {
            require 'App/View/' . $template . '.php';
        } else {
            $multiTemplate = str_replace('.', '/', $template);
            if (file_exists('App/View/' . $multiTemplate . '.php')) {
                require 'App/View/' . $multiTemplate . '.php';
            } else {
                echo 'Файл не найден';
                return false;
            }
        }
    }

}
