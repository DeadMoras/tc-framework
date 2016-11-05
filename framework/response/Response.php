<?php

namespace framework\response;

use framework\facade\Facade;

class Response extends Facade
{
    /**
     *
     * @var object 
     */
    private $object;

    public function __construct()
    {
        $this->object = parent::__construct(new ResponseB);
    }
    
    /**
     * 
     * @return mixed
     */
    public function code($code = false)
    {
        return $this->object->status($code);
    }
    
    /**
     * 
     * @param string $key
     * @param string $values
     * @param boolean $replace
     */
    public function header($key, $values)
    {
        $this->object->header($key, $values);
    }
    
    /**
     * 
     * @return mixed
     */
    public function getContent()
    {
        return $this->object->getContent();
    }
    
    /**
     * 
     * @param string $content
     */
    public function setContent($content)
    {
        $this->object->setContent($content);
    }
    
    /**
     * 
     * @param string $url
     * @return ...
     */
    public function redirect($url)
    {
        return $this->object->redirect($url);
    }
    
    /**
     * 
     * @param string $json
     */
    public function json($json)
    {
        return $this->object->json($json);
    }

}
