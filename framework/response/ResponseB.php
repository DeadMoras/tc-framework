<?php

namespace framework\response;

class ResponseB
{
    /**
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        header("Content-type: $content");

        return $this;
    }

    /**
     *
     * @param string $key
     * @param string $values
     * @return $this
     */
    public function header($key, $values)
    {
        header("$key: $values");

        return $this;
    }

    /**
     *
     * @param string $code
     * @return void
     */
    public function code($code)
    {
        if ( $code !== false && is_numeric($code) ) {
            http_response_code($code);
        } else {
            return http_response_code();
        }
    }

    /**
     *
     * @param string $url
     * @return $this
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
