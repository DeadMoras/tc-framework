<?php

namespace framework\response;

class ResponseB
{
    /**
     * 
     * @param string $content
     */
    public function setContent($content)
    {
        header("Content-type: $content");
    }
    
    /**
     * 
     * @param string $key
     * @param string $values
     */
    public function header($key, $values)
    {
        header("$key: $values");
    }
    
    /**
     * 
     * @param string $code
     * @return void
     */
    public function code($code)
    {
        if ($code !== false && is_numeric($code)) {
            http_response_code($code);
        } else {
            return http_response_code();
        }
    }
    
    /**
     * 
     * @param strng $url
     */
    public function redirect($url)
    {
        header("Location: $url");
    }
    
    /**
     * 
     * @param mixed $json
     * @return json
     */
    public function json($json)
    {
        $this->setContent('application/json');
        return json_encode($json);
    }
}
