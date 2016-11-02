<?php

namespace app\config;

/**
 * class for loading public files
 */

class Template
{
    /**
     *
     * @var array
     * example: 'name.js', 'name2.js'
     */
    public static $js = [
        'name.js'
    ];
    
    /**
     *
     * @var array
     * example: 'name.css', 'name2.css'
     */
    public static $css = [
        'name.css'
    ];
    
    /**
     * 
     * @return void
     * not use
     */
    public static function getJs()
    {
        return self::$js;
    }
    
    /**
     * 
     * @return void
     * not use
     */
    public static function getCss()
    {
        return self::$css;
    }
}
